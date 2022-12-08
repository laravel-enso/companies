<?php

namespace LaravelEnso\Companies\Enums;

enum Status: int
{
    case Active = 1;
    case Overdue = 2;
    case Litigation = 3;
    case Insolvent = 4;
    case Deregistered = 5;
}
