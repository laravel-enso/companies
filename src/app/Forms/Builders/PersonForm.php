<?php

namespace LaravelEnso\Companies\App\Forms\Builders;

use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Forms\App\Services\Form;
use LaravelEnso\People\App\Models\Person;

class PersonForm
{
    protected const TemplatePath = __DIR__.'/../Templates/person.json';

    protected Form $form;
    protected Company $company;

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
        return $this->form->actions('update')
            ->value('position', $person->position($this->company))
            ->readonly('id')
            ->edit($person);
    }

    public function company(Company $company)
    {
        $this->company = $company;

        return $this;
    }
}
