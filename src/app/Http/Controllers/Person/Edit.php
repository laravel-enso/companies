<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Companies\app\Forms\Builders\PersonForm;

class Edit extends Controller
{
    public function __invoke(Person $person, PersonForm $form)
    {
        return ['form' => $form->edit($person)];
    }
}
