<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Companies\app\Http\Requests\ValidatePersonUpdate;

class Update extends Controller
{
    public function __invoke(ValidatePersonUpdate $request, Person $person)
    {
        $person->companies()->updateExistingPivot(
            $request->get('company_id'), $request->only('position')
        );

        return [
            'message' => __('The Person have been successfully updated'),
        ];
    }
}
