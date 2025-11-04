<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;
use App\Models\Motorcycle;

class MotorcycleAIService
{
    protected $apiKey;
    protected $baseUrl;
    protected $model;

    public function __construct()
    {
        $this->apiKey  = env('GEMINI_API_KEY'); 
        $this->baseUrl = "https://generativelanguage.googleapis.com/v1";
        $this->model   = env('GEMINI_MODEL', 'gemini-2.5-pro');
    }
    
    public function getMaintenanceRecommendations(string $brand, string $model): array
    {
        $motorcycle = Motorcycle::where('brand', $brand)
            ->where('model', $model)
            ->first();

        if ($motorcycle && !empty($motorcycle->maintenance)) {
            return $motorcycle->maintenance;
        }

        $prompt = "
            You are a certified motorcycle maintenance expert familiar with motorcycles commonly used in the Philippines.

            Your goal is to create an official-style maintenance summary and schedule for the {$brand} {$model} motorcycle.

            REQUIREMENTS:
            - Use verified data from manufacturer service manuals or official brand sources.
            - If unavailable, use a close equivalent model with the same engine displacement and type.
            - Adjust maintenance intervals for tropical Philippine conditions (hot, humid, dusty roads).
            - Provide a short overview (1–2 sentences) summarizing:
            - The motorcycle’s general reliability
            - Its maintenance frequency
            - Any known care tips for local conditions
            - Even if exact schedule data is limited, the overview MUST still be generated based on your expert knowledge.

            OUTPUT FORMAT (STRICT JSON ONLY):
            {
                \"overview\": \"Short AI-written summary about this motorcycle’s maintenance behavior.\",
                \"schedule\": [
                    { \"task\": \"Replace engine oil\", \"interval\": \"Every 3,000 km or 3 months\" },
                    { \"task\": \"Check and clean air filter\", \"interval\": \"Every 6,000 km\" }
                ],
            }

            RULES:
            - Return only raw valid JSON. No markdown, code fences, or text explanations.
            - The overview must always be present and written naturally (no generic or placeholder text).
            - Be clear, factual, and beginner-friendly.
        ";

        try {
            $response = Http::withHeaders([
                'Content-Type'   => 'application/json',
                'x-goog-api-key' => $this->apiKey,
            ])->timeout(60)->post("{$this->baseUrl}/models/{$this->model}:generateContent", [
                "contents" => [
                    ["parts" => [["text" => $prompt]]]
                ]
            ]);

            $raw = $response->json('candidates.0.content.parts.0.text');

            $cleanJson = preg_replace('/```(?:json)?|```/i', '', trim($raw ?? ''));
            $payload = $this->parseJsonStrict($cleanJson);

            if ($payload && !empty($payload['overview'])) {
                if ($motorcycle) {
                    $motorcycle->update(['maintenance' => $payload]);
                }
                return $payload;
            }

        } catch (\Throwable $e) {
            \Log::error('AI Maintenance Fetch Failed', [
                'brand' => $brand,
                'model' => $model,
                'error' => $e->getMessage(),
            ]);
        }

        return [
            'overview' => "This motorcycle typically requires regular oil changes, chain cleaning, and inspection every few thousand kilometers for smooth performance in Philippine conditions.",
            'schedule' => [],
        ];
    }
    
    public function getCommonIssues(string $brand, string $model, string $mode = 'short'): array
    {
        $motorcycle = Motorcycle::where('brand', $brand)
            ->where('model', $model)
            ->first();

        if ($motorcycle && !empty($motorcycle->issues)) {
            return $motorcycle->issues;
        }

        $prompt = "You are a motorcycle expert familiar with owner reports from the Philippines. 
            List the top 5 common issues for the {$brand} {$model}. 

            Return the response strictly as a JSON object in this format:

            {
                \"basic\": [
                    {
                        \"title\": \"...\",
                        \"steps\": [\"...\",\"...\",\"...\",\"...\",\"...\"],
                        \"source\": \"...\",
                    }
                ],
                \"mechanic_required\": [
                    {
                        \"issue\": \"...\",
                        \"source\": \"...\",
                    }
                ]
            }

            Rules:
            - For ‘source’, provide the manufacturer service manual, an official brand advisory, or a reputable Philippines‑based owner forum/report.
            - \"basic\": common issues or problem reported by real motorcycle owner that can typically
             be resolved with simple at-home troubleshooting.
            - Each \"basic\" item must include a concise title and exactly five actionable steps.
            - Steps must be practical and specific (e.g., check, clean, adjust, replace, or test components) 
            or if not resolve in basic troubleshooting and if that part is hardly damaged recommend to but new parts for that motorcycle.
            - \"mechanic_required\": issues that generally require professional intervention.
            - Respond strictly in JSON format only; do not include markdown, commentary, or code fences.
            - Provide no extra text before or after the JSON.
            - Limit the output to a maximum of 5 items for both \"basic\" and \"mechanic_required\".";

            $response = Http::withHeaders([
                'Content-Type'   => 'application/json',
                'x-goog-api-key' => $this->apiKey,
            ])->timeout(60)->post("{$this->baseUrl}/models/{$this->model}:generateContent", [
                "contents" => [
                    ["parts" => [["text" => $prompt]]]
                ]
            ]);


        $raw = $response->json('candidates.0.content.parts.0.text');

        $payload = $this->parseJsonStrict($raw);

        if ($motorcycle && $payload && (!empty($payload['basic']) || !empty($payload['mechanic_required']))) {
            $motorcycle->update(['issues' => $payload]);
            return $payload;
        }

        return [
            'basic' => [],
            'mechanic_required' => [],
        ];
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

    protected function normalizePayload(array $data): array
    {
        $basic = [];
        if (!empty($data['basic']) && is_array($data['basic'])) {
            foreach ($data['basic'] as $item) {
                $title = isset($item['title']) ? trim((string)$item['title']) : null;
                $steps = isset($item['steps']) && is_array($item['steps']) ? $item['steps'] : [];
                $steps = array_values(array_filter(array_map(fn($s) => trim((string)$s), $steps)));

                if ($title && !empty($steps)) {
                    $basic[] = [
                        'title' => mb_strimwidth($title, 0, 120),
                        'steps' => array_slice($steps, 0, 5),
                    ];
                }
            }
            $basic = array_slice($basic, 0, 5);
        }

        $mechanic = [];
        if (!empty($data['mechanic_required']) && is_array($data['mechanic_required'])) {
            foreach ($data['mechanic_required'] as $t) {
                $t = trim((string)$t);
                if ($t !== '') {
                    $mechanic[] = mb_strimwidth($t, 0, 120);
                }
            }
            $mechanic = array_slice($mechanic, 0, 5);
        }

        return [
            'basic' => $basic,
            'mechanic_required' => $mechanic,
        ];
    }

    public function generateDescription(string $productName): ?string
    {
        $prompt = "Write a clear and professional product description for '{$productName}'.
        Describe:
        1. What the product is and what it’s used for.
        2. Its main purpose or function — how it helps the user or why it’s needed.
        3. Why the product is important, useful, or beneficial in real-world situations.
        Keep the tone factual, concise, and trustworthy (2–3 sentences total).
        Avoid marketing fluff, markdown, commentary, or extra text.";
    
        $response = Http::withHeaders([
            'Content-Type'   => 'application/json',
            'x-goog-api-key' => $this->apiKey,
        ])->post("{$this->baseUrl}/models/{$this->model}:generateContent", [
            "contents" => [
                ["parts" => [["text" => $prompt]]]
            ]
        ]);
    
        if ($response->successful()) {
            return trim($response->json('candidates.0.content.parts.0.text') ?? '');
        }
    
        return null;
    }    
}