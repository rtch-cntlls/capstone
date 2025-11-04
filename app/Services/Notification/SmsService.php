<?php

namespace App\Services\Notification;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected string $endpoint;
    protected string $token;

    public function __construct()
    {
        $this->endpoint = config('services.iprog_sms.endpoint');
        $this->token    = config('services.iprog_sms.api_token');
    }

    public function sendSms(string $phoneNumber, string $message): bool
    {
        try {
            $payload = [
                'api_token'    => $this->token,
                'phone_number' => $phoneNumber,
                'message'      => $message,
            ];

            $response = Http::post("{$this->endpoint}/sms_messages", $payload);

            if ($response->ok() && $response->json('status') === 200) {
                return true;
            }

            Log::error('IPROG SMS send failed', [
                'phone'    => $phoneNumber,
                'message'  => $message,
                'response' => $response->body(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('IPROG SMS exception', [
                'phone'   => $phoneNumber,
                'message' => $message,
                'error'   => $e->getMessage(),
            ]);
            return false;
        }
    }
}
