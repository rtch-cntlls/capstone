<?php

namespace App\Services\Api;

use App\Models\Motorcycle;
use App\Models\MotorcycleMaintenanceLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MaintenancePredictionService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey  = env('GEMINI_API_KEY');
        $this->baseUrl = "https://generativelanguage.googleapis.com/v1beta/models";
        $this->model   = env('GEMINI_MODEL', 'gemini-2.0-pro');
    }

    public function predict(Motorcycle $motorcycle, int $currentMileage = 0): ?MotorcycleMaintenanceLog
    {
        try {
            $latestLog = $motorcycle->maintenanceLogs()->latest('last_done_at')->first();
            $maintenance = $motorcycle->maintenance ?? ['overview' => '', 'schedule' => []];

            if (!$latestLog) {
                Log::info("No maintenance logs found for motorcycle ID {$motorcycle->motorcycle_id}.");
                return null;
            }

            $serviceType = strtolower(trim($latestLog->service_type ?? ''));
            $schedule = $maintenance['schedule'] ?? [];

            if (empty($schedule)) {
                Log::info("No maintenance schedule found for motorcycle ID {$motorcycle->motorcycle_id}.");
                return null;
            }

            $normalize = function ($text) {
                $text = strtolower($text);
                $text = str_replace(
                    ['inspection', 'check', 'and', 'the', 'of', 'for', 'at', 'a', ',', '.', '(', ')'],
                    '',
                    $text
                );
                $text = preg_replace('/\s+/', ' ', $text);
                return trim($text);
            };

            $normalizedService = $normalize($serviceType);
            $relatedTasks = [];

            foreach ($schedule as $item) {
                $task = $normalize($item['task'] ?? '');

                $serviceWords = array_filter(explode(' ', $normalizedService));
                $taskWords = array_filter(explode(' ', $task));

                $common = array_intersect($serviceWords, $taskWords);

                foreach ($serviceWords as $sw) {
                    foreach ($taskWords as $tw) {
                        if (levenshtein($sw, $tw) <= 3) {
                            $common[] = $tw;
                        }
                    }
                }

                if (count(array_unique($common)) > 0) {
                    $relatedTasks[] = $item;
                    Log::debug("Service '{$latestLog->service_type}' matched with schedule task '{$item['task']}' by keywords: " . implode(', ', array_unique($common)));
                }
            }

            if (empty($relatedTasks)) {
                Log::info("Service type '{$latestLog->service_type}' not related to any schedule task for motorcycle ID {$motorcycle->motorcycle_id}. Prediction skipped.");
                return null;
            }

            $scheduleText = '';
            foreach ($relatedTasks as $item) {
                $scheduleText .= "- {$item['task']}: {$item['interval']}\n";
            }

            $prompt = <<<PROMPT
                IMPORTANT: Respond strictly in valid JSON format only.
                No markdown, no explanations, no extra text outside JSON.

                You are an expert motorcycle maintenance AI.
                Focus ONLY on the service type related to: "{$latestLog->service_type}".
                Use the related maintenance task(s) below as the basis of your estimation.

                Estimate:
                1. The next due mileage.
                2. The next due date (based on the interval and typical usage).
                3. A short reasoning paragraph.

                Respond strictly in raw JSON with this format:

                {
                    "next_due_mileage": number,
                    "next_due_date": "YYYY-MM-DD",
                    "reasoning": "string"
                }

                Motorcycle details:
                - Model: {$motorcycle->make} {$motorcycle->model}
                - Year: {$motorcycle->year}
                - Current Mileage: {$currentMileage} km

                Latest Maintenance:
                - Service Type: {$latestLog->service_type}
                - Mileage at Service: {$latestLog->mileage_at_service} km
                - Date of Service: {$latestLog->last_done_at}

                Related Maintenance Task(s):
                {$scheduleText}
            PROMPT;

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
                Log::error("Gemini API error: " . $response->body());
                return null;
            }

            $result = $response->json();
            $aiText = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;

            Log::debug("Gemini Raw Response for {$motorcycle->motorcycle_id}: " . $aiText);

            $json = $this->parseJsonStrict($aiText);
            if (!$json) {
                Log::warning("Invalid AI JSON response: " . $aiText);
                return null;
            }

            $nextDueMileage = $json['next_due_mileage'] ?? null;
            $nextDueDate = isset($json['next_due_date'])
                ? Carbon::parse($json['next_due_date'])
                : null;
            $reasoning = $json['reasoning'] ?? 'AI did not provide reasoning.';

            $latestLog->update([
                'next_due_mileage' => $nextDueMileage,
                'next_due_date' => $nextDueDate,
                'ai_reasoning' => $reasoning,
            ]);

            Log::info("Gemini AI prediction completed for motorcycle ID {$motorcycle->motorcycle_id} (Service: {$latestLog->service_type}).");

            return $latestLog;
        } catch (\Throwable $e) {
            Log::error("Gemini AI prediction failed for motorcycle ID {$motorcycle->motorcycle_id}: " . $e->getMessage());
            return null;
        }
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
