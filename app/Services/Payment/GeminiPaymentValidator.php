<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class GeminiPaymentValidator
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey  = env('GEMINI_API_KEY');
        $this->baseUrl = "https://generativelanguage.googleapis.com/v1beta/models";
        $this->model   = env('GEMINI_MODEL', 'gemini-2.5-pro');
    }

    public function validateScreenshot(string $filePath, float $amount): ?array
    {
        if (!file_exists($filePath)) {
            Log::error("GeminiPaymentValidator: File not found", ['path' => $filePath]);
            return null;
        }

        $mimeType = mime_content_type($filePath);
        if (!str_starts_with($mimeType, 'image/')) {
            Log::error("GeminiPaymentValidator: Unsupported file type", ['type' => $mimeType]);
            return null;
        }

        $imageData = base64_encode(file_get_contents($filePath));

        $prompt = <<<PROMPT
            You are a system that verifies **GCash payment screenshots**.
            Tasks:
            1. Extract the paid amount from the image.
            2. Determine if it looks like a real GCash confirmation (logo, date, reference number).
            3. Extract the GCash reference number.
            4. Extract the transaction date as "YYYY-MM-DD" format only (no time).
            5. Return **only** valid JSON — no extra text.

            JSON format:
            {
                "amount": 0.00,
                "valid_format": true | false,
                "reference_number": "",
                "transaction_date": "YYYY-MM-DD"
            }

            Expected amount: {$amount}
        PROMPT;

        $payload = [
            "contents" => [
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => $prompt],
                        [
                            "inline_data" => [
                                "mime_type" => $mimeType,
                                "data"      => $imageData,
                            ]
                        ],
                    ],
                ],
            ],
        ];

        $url = "{$this->baseUrl}/{$this->model}:generateContent?key={$this->apiKey}";

        try {
            $response = Http::retry(2, 1000)
                ->timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $payload);

            $status = $response->status();
            $result = $response->json();

            Log::info('🧾 GeminiPaymentValidator API Response', [
                'status' => $status,
                'result' => $result,
            ]);

            if (!$response->ok()) {
                Log::error('GeminiPaymentValidator: API error', [
                    'status' => $status,
                    'body'   => $response->body(),
                ]);
                return null;
            }

            $outputText = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
            if (!$outputText) {
                Log::warning('GeminiPaymentValidator: Empty Gemini response', ['result' => $result]);
                return null;
            }

            $jsonStart = strpos($outputText, '{');
            $jsonEnd   = strrpos($outputText, '}');

            if ($jsonStart === false || $jsonEnd === false) {
                Log::warning('GeminiPaymentValidator: JSON not found', ['output' => $outputText]);
                return null;
            }

            $jsonStr = substr($outputText, $jsonStart, $jsonEnd - $jsonStart + 1);
            $decoded = json_decode($jsonStr, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('GeminiPaymentValidator: JSON decode failed', [
                    'error' => json_last_error_msg(),
                    'json'  => $jsonStr,
                ]);
                return null;
            }

            $amount     = isset($decoded['amount']) ? floatval($decoded['amount']) : 0;
            $valid      = isset($decoded['valid_format']) ? boolval($decoded['valid_format']) : false;
            $ref        = $decoded['reference_number'] ?? null;
            $txDate     = $decoded['transaction_date'] ?? null;
            $tooOld     = false;

            if ($txDate) {
                try {
                    $txDateObj = Carbon::createFromFormat('Y-m-d', $txDate);
                    $tooOld = $txDateObj->lt(Carbon::today());
                } catch (\Exception $e) {
                    Log::warning('GeminiPaymentValidator: Invalid transaction_date format', [
                        'value' => $txDate,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            if ($ref === null) {
                Log::warning('GeminiPaymentValidator: reference_number missing', ['decoded' => $decoded]);
            }

            return [
                'amount'            => $amount,
                'valid_format'      => $valid,
                'reference_number'  => $ref,
                'transaction_date'  => $txDate,
                'too_old'           => $tooOld,
            ];

        } catch (\Throwable $e) {
            Log::error('GeminiPaymentValidator exception', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
            return null;
        }
    }

    public static function isAmountValid(float $apiAmount, float $expectedAmount, float $tolerance = 0.01): bool
    {
        return abs($apiAmount - $expectedAmount) <= $tolerance;
    }
}
