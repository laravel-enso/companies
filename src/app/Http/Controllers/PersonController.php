<?php

namespace LaravelEnso\Companies\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Companies\app\Forms\Builders\PersonForm;
use LaravelEnso\Companies\app\Http\Resources\Person as Resource;
use LaravelEnso\Companies\app\Http\Requests\ValidatePersonRequest;

class PersonController extends Controller
{
    public function index(Company $company)
    {
        return Resource::collection(
            $company->people()->get()
        );
    }

    public function create(Company $company, PersonForm $form)
    {
        return ['form' => $form->create($company)];
    }

    public function store(ValidatePersonRequest $request)
    {
        Person::find($request->get('id'))
            ->update($request->validated());

        return [
            'message' => __('The Person was successfully created'),
        ];
    }

    public function edit(Person $person, PersonForm $form)
    {
        return ['form' => $form->edit($person)];
    }

    public function update(ValidatePersonRequest $request, Person $person)
    {
        $person->update($request->validated());

        return [
            'message' => __('The Person have been successfully updated'),
        ];
    }

    public function destroy(Person $person)
    {
        $person->dissociateCompany();
    }
}
