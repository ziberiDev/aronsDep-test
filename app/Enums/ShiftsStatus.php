<?php

namespace App\Enums;

enum ShiftsStatus: string
{
    case COMPLETE = 'Complete';
    case FAILED = 'Failed';
    case PENDING = 'Pending';
    case PROCESSING = 'Processing';

}
