<?php

namespace Reminder\App\Controllers;

use Reminder\App\Services\DateService;
use Reminder\App\Services\TelegramService;
use Reminder\App\ValueObjects\MessagesValueObject;

class ApplicationController
{
    protected MessagesValueObject $messagesValueObject;
    protected DateService $dateService;
    protected TelegramService $telegramService;

    /**
     * @param DateService $dateService
     * @param TelegramService $telegramService
     * @param MessagesValueObject $messagesValueObject
     */
    public function __construct(
        DateService $dateService,
        TelegramService $telegramService,
        MessagesValueObject $messagesValueObject
    )
    {
        $this->dateService = $dateService;
        $this->telegramService = $telegramService;
        $this->messagesValueObject = $messagesValueObject;
    }

    /**
     * @return void
     */
    public function start(): void
    {
        $this->telegramService->sendMessage($this->messagesValueObject->getFridayLastDayMessage());

        return;
        if ($this->dateService->isLastDayOfMonth()) {
            if ($this->dateService->isFriday()) {
                $this->telegramService->sendMessage($this->messagesValueObject->getFridayLastDayMessage());

                return;
            }

            $this->telegramService->sendMessage($this->messagesValueObject->getLastDayMessage());

            return;
        }

        if ($this->dateService->isFriday()) {
            $this->telegramService->sendMessage($this->messagesValueObject->getFridayMessage());
        }
    }
}