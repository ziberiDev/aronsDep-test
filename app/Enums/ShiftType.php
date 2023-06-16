<?php

namespace App\Enums;

enum ShiftType: string
{
    case DAY = 'Day';

    case NIGHT = 'Night';

    case HOLIDAY = 'Holiday';
}
