<?php

namespace LaravelEnso\Companies\app\Enums;

use LaravelEnso\Enums\app\Services\Enum;

class CompanyStatuses extends Enum
{
    const Active = 1;
    const Overdue = 2;
    const Litigation = 3;
    const Insolvent = 4;
    const Deregistered = 5;
}
