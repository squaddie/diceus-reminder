<?php

namespace Reminder\App\Services;

class TelegramService
{
    const REQUEST_URL_PATTERN = 'https://api.telegram.org/bot%s/sendMessage?chat_id=%s&text=%s';

    public function sendMessage(string $message): void
    {
        file_get_contents($this->prepareSendMessageUrl($message));
    }

    private function prepareSendMessageUrl(string $message): string
    {
        return sprintf(self::REQUEST_URL_PATTERN, env('BOT_API_KEY'), env('GROUP_CHAT_ID'), $message);
    }
}
