<?php

namespace LaravelEnso\Companies\app\Forms\Builders;

use LaravelEnso\Forms\app\Services\Form;
use LaravelEnso\People\app\Models\Person;

class PersonForm
{
    private const TemplatePath = __DIR__.'/../Templates/person.json';

    private $form;
    private $company;

    public function __construct()
    {
        $this->form = new Form(static::TemplatePath);
    }

    public function create()
    {
        return $this->form
            ->actions('store')
            ->create();
    }

    public function edit(Person $person)
    {
        return $this->form
            ->value(
                'position', $person->companies()
                    ->wherePivot('company_id', $this->company->id)
                    ->first()->pivot->position
            )->actions('update')
            ->edit($person);
    }

    public function company($company)
    {
        $this->company = $company;

        return $this;
    }
}
