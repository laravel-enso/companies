<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Http\Requests\ValidatePersonStore;
use LaravelEnso\Companies\App\Models\Company;

class Store extends Controller
{
    public function __invoke(ValidatePersonStore $request)
    {
        Company::find($request->get('company_id'))
            ->attachPerson($request->get('id'), $request->get('position'));

        return ['message' => __('The person was successfully assigned')];
    }
}
