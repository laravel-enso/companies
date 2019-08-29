<?php

namespace LaravelEnso\Companies\app\Enums;

use LaravelEnso\Helpers\app\Classes\Enum;

class CompanyStatuses extends Enum
{
    const Active = 1;
    const Overdue = 2;
    const Litigation = 3;
    const Insolvent = 3;
    const Deregistered = 4;
}
