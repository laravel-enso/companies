<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;

class Destroy extends Controller
{
    public function __invoke(Person $person)
    {
        $person->dissociateCompany();
    }
}
