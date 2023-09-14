<?php

namespace Reminder\App\Services;

class MSService
{
    const HEADERS = [
        'Content-Type: application/json',
    ];

    private CurlService $curlService;

    public function __construct(CurlService $curlService)
    {
        $this->curlService = $curlService;
    }

    public function sendMessage(string $message): void
    {
        $payload = $this->getRequestPayload($message);

        foreach ($this->getIncomingWebhooks() as $url) {
            $this->curlService->sendPostRequest($url, $payload, self::HEADERS);
        }
    }

    private function getIncomingWebhooks(): array
    {
        return [
            env('D6_UNIT_INCOMING_WEBHOOK_URL'),
        ];
    }

    private function getRequestPayload(string $message): array
    {
        return [
            '@type' => 'MessageCard',
            '@context' => 'http://schema.org/extensions',
            'themeColor' => '0076D7',
            'summary' => 'Sad cat asking you to log a time',
            'sections' => [
                [
                    'activityTitle' => 'Sad cat asking you to log a time',
                    'activitySubtitle' => $message,
                    'activityImage' => 'https://media.tenor.com/KYygGhaDCLQAAAAd/cat-crying.gif',
                    'markdown' => true
                ]
            ]
        ];
    }
}
