<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Companies\app\Http\Requests\ValidatePersonStore;

class Store extends Controller
{
    public function __invoke(ValidatePersonStore $request)
    {
        Person::find($request->get('id'))
            ->attachCompanies(
                $request->get('company_id'), $request->get('position')
            );

        return [
            'message' => __('The Person was successfully created'),
        ];
    }
}
