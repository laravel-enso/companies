<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Http\Requests\ValidatePersonUpdate;
use LaravelEnso\People\App\Models\Person;

class Update extends Controller
{
    public function __invoke(ValidatePersonUpdate $request, Person $person)
    {
        $person->companies()->updateExistingPivot(
            $request->get('company_id'), $request->only('position')
        );

        return ['message' => __('The person has been successfully updated')];
    }
}
