<?php

namespace LaravelEnso\Companies\Enums;

use LaravelEnso\Enums\Services\Enum;

class Statuses extends Enum
{
    public const Active = 1;
    public const Overdue = 2;
    public const Litigation = 3;
    public const Insolvent = 4;
    public const Deregistered = 5;
}
