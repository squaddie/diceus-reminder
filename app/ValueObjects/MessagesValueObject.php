<?php

namespace Reminder\App\ValueObjects;

class MessagesValueObject
{
    public function getFridayMessage(): string
    {
        return 'Hello everyone, today is Friday, the last day of the week, log the time please! ' . env('SERVICE_URL');
    }

    public function getFridayLastDayMessage(): string
    {
        return 'Hello everyone, today is Friday, the last day of the week and month, log the time please! ' . env('SERVICE_URL');
    }

    public function getLastDayMessage(): string
    {
        return 'Hello everyone, today is the last day of the month, log the time please! ' . env('SERVICE_URL');
    }
}
