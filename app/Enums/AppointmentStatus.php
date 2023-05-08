<?php

namespace App\Enums;

enum AppointmentStatus: int
{
    case CANCELLED = -2;
    case REJECTED = -1;
    case PENDING = 0;
    case ACCEPTED = 1;
    case FINISHED = 2;
}
