<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Companies\app\Http\Requests\ValidatePersonRequest;

class Update extends Controller
{
    public function __invoke(ValidatePersonRequest $request, Person $person)
    {
        $person->update($request->validated());

        return [
            'message' => __('The Person have been successfully updated'),
        ];
    }
}
