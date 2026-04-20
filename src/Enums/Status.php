<?php

namespace LaravelEnso\Companies\Enums;

use Illuminate\Support\Collection;
use LaravelEnso\Enums\Contracts\Frontend;
use LaravelEnso\Enums\Contracts\Select;
use LaravelEnso\Enums\Traits\Select as Options;

enum Status: int implements Select, Frontend
{
    use Options;

    case Active = 1;
    case Overdue = 2;
    case Litigation = 3;
    case Insolvent = 4;
    case Deregistered = 5;

    public static function registerBy(): string
    {
        return 'companyStatuses';
    }

    public static function values()
    {
        return Collection::wrap(self::cases())->map(fn ($case) => $case->value);
    }
}
