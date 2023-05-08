<?php

namespace App\Enums;

enum EmployeeRole: string
{
    case EMPLOYEE = 'employee';
    case MANAGER = 'manager';
    case OWNER = 'owner';
}
