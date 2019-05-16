<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Companies\app\Http\Requests\ValidatePersonRequest;

class Store extends Controller
{
    public function __invoke(ValidatePersonRequest $request)
    {
        Person::find($request->get('id'))
            ->update($request->validated());

        return [
            'message' => __('The Person was successfully created'),
        ];
    }
}
