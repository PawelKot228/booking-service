<?php

namespace App\Enums;

enum AppointmentStatus: int
{
    case REJECTED = -1;
    case PENDING = 0;
    case ACCEPTED = 1;
    case FINISHED = 2;
}
