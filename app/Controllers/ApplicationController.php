<?php

namespace Reminder\App\Controllers;

use Reminder\App\Services\DateService;
use Reminder\App\Services\MSService;
use Reminder\App\Services\TelegramService;
use Reminder\App\ValueObjects\MessagesValueObject;

class ApplicationController
{
    protected MessagesValueObject $messagesValueObject;
    protected DateService $dateService;
    protected TelegramService $telegramService;
    protected MSService $msService;

    public function __construct(
        DateService $dateService,
        TelegramService $telegramService,
        MSService $msService,
        MessagesValueObject $messagesValueObject
    )
    {
        $this->dateService = $dateService;
        $this->telegramService = $telegramService;
        $this->msService = $msService;
        $this->messagesValueObject = $messagesValueObject;
    }

    public function start(): void
    {
        if ($this->dateService->isLastDayOfMonth()) {
            if ($this->dateService->isFriday()) {
                $this->telegramService->sendMessage($this->messagesValueObject->getFridayLastDayMessage());
                $this->msService->sendMessage($this->messagesValueObject->getFridayLastDayMessage());

                return;
            }

            $this->telegramService->sendMessage($this->messagesValueObject->getLastDayMessage());
            $this->msService->sendMessage($this->messagesValueObject->getLastDayMessage());

            return;
        }

        if ($this->dateService->isFriday()) {
            $this->telegramService->sendMessage($this->messagesValueObject->getFridayMessage());
            $this->msService->sendMessage($this->messagesValueObject->getFridayMessage());
        }
    }
}
