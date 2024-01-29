<?php

namespace App\Enums;

enum VaccinationStatus: string
{
    case NOT_VACCINATED = 'Not Vaccinated';
    case SCHEDULED = 'Scheduled';
    case VACCINATED = 'Vaccinated';

    public function getColor(): string
    {
        return match ($this) {
            self::NOT_VACCINATED => 'danger',
            self::SCHEDULED => 'warning',
            self::VACCINATED => 'success',
        };
    }

}
