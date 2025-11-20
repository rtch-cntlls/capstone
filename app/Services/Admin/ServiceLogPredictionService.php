<?php

namespace App\Services\Admin;

use App\Models\ServiceLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ServiceLogPredictionService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey  = env('GEMINI_API_KEY');
        $this->baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models';
        $this->model   = env('GEMINI_MODEL', 'gemini-2.5-flash');
    }

    public function predict(ServiceLog $log): ?ServiceLog
    {
       if (empty($log->service?->name)) {
            return null;
        }

        try {
            $prompt = $this->buildPrompt($log);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}/{$this->model}:generateContent?key={$this->apiKey}", [
                'contents' => [
                    ['role' => 'user', 'parts' => [['text' => $prompt]]],
                ],
                'generationConfig' => [
                    'temperature' => 0.3,
                    'response_mime_type' => 'application/json',
                ],
            ]);

            if (!$response->successful()) {
                Log::error('Gemini API error (service logs): ' . $response->body());
                return null;
            }

            $result = $response->json();
            $aiText = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;

            Log::debug("Gemini Raw Response for service_log #{$log->id}: " . $aiText);

            $json = $this->parseJsonStrict($aiText);
            if (!$json) {
                Log::warning('Invalid AI JSON response for service log: ' . $aiText);
                return null;
            }

            $nextDueMileage = $json['next_due_mileage'] ?? null;
            $nextDueDate = isset($json['next_due_date'])
                ? Carbon::parse($json['next_due_date'])
                : null;
            $reasoning = $json['reasoning'] ?? 'AI did not provide reasoning.';

            $log->update([
                'next_due_mileage' => $nextDueMileage,
                'next_due_date' => $nextDueDate,
                'ai_reasoning' => $reasoning,
            ]);

            return $log;
        } catch (\Throwable $e) {
            Log::error('Gemini AI prediction failed for service log #' . $log->id . ': ' . $e->getMessage());
            return null;
        }
    }

    protected function buildPrompt(ServiceLog $log): string
    {
        $brand = $log->motorcycle_brand ?? 'Unknown';
        $model = $log->motorcycle_model ?? '';
        $currentMileage = (int) ($log->mileage ?? 0);
        $serviceType = $log->service->name ?? '';
        $serviceDate = $log->service_date ?? null;
        $roadCondition = $log->road_condition ?? 'Unknown';
        $usageFrequency = $log->usage_frequency ?? 'Unknown';

        return <<<PROMPT
            IMPORTANT: Respond strictly in valid JSON format only.
            No markdown, no explanations, no extra text outside JSON.

            You are an expert motorcycle maintenance AI.
            Focus ONLY on the service type related to: "{$serviceType}".

            Consider the rider context:
            - Typical Road Condition: {$roadCondition}
            - Usage Frequency: {$usageFrequency}

            Estimate:
            1. The next due mileage.
            2. The next due date (based on the interval and typical usage).
            3. A short reasoning paragraph.

            Applicability rule:
            - First, determine if the selected service actually applies to the given motorcycle brand/model.
            - If the service is NOT applicable (e.g., carburetor service on a fuel-injected model, drum brake service on a disc brake setup, 2-stroke vs 4-stroke specifics, model design limitations, etc.), then set both fields to null and explain why in reasoning.
            - Non-applicable response format in that case:
            {
                "next_due_mileage": null,
                "next_due_date": null,
                "reasoning": "Explain why the service does not apply to this motorcycle and suggest appropriate alternatives if relevant."
            }

            Respond strictly in raw JSON with this format:
            {
            "next_due_mileage": number,
            "next_due_date": "YYYY-MM-DD",
            "reasoning": "string"
            }

            Motorcycle details:
            - Model: {$brand} {$model}
            - Current Mileage: {$currentMileage} km

            Latest Maintenance:
            - Service Type: {$serviceType}
            - Mileage at Service: {$currentMileage} km
            - Date of Service: {$serviceDate}
            PROMPT;
    }

    protected function parseJsonStrict(?string $raw): ?array
    {
        if (!$raw) return null;

        $clean = preg_replace('/[▶…]+$/u', '', trim($raw));
        $decoded = json_decode($clean, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        if (preg_match('/\{.*\}/s', $clean, $m)) {
            $decoded = json_decode($m[0], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }
        return null;
    }
}
