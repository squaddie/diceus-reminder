<?php

namespace Reminder\App\Services;

use DateTime;
use DateTimeZone;

class DateService
{
    const TIMEZONE = 'Europe/Kiev';
    const FRIDAY_WEEK_INDEX = 5;
    const DAY_OF_MONTH_FORMAT_PARAMETER = 'j';
    const DAYS_IN_MONTH_PARAMETER = 't';
    const CURRENT_DAY_PARAMETER = 'N';

    private DateTime $dateTimeInstance;

    public function __construct()
    {
        $timezone = new DateTimeZone(self::TIMEZONE);
        $this->dateTimeInstance = new DateTime();
//        $this->dateTimeInstance->setDate(2023, 4, 31); //todo for testing purpose
        $this->dateTimeInstance->setTimezone($timezone);
    }

    public function isFriday(): bool
    {
        return $this->getCurrentDay() === self::FRIDAY_WEEK_INDEX;
    }

    public function isLastDayOfMonth(): bool
    {
        return (int)$this->dateTimeInstance->format(self::DAYS_IN_MONTH_PARAMETER)
            === (int)$this->dateTimeInstance->format(self::DAY_OF_MONTH_FORMAT_PARAMETER);
    }

    private function getCurrentDay(): int
    {
        return (int)$this->dateTimeInstance->format(self::CURRENT_DAY_PARAMETER);
    }
}
