<?php

namespace LaravelEnso\Companies\app\Forms\Builders;

use LaravelEnso\Forms\app\Services\Form;
use LaravelEnso\People\app\Models\Person;

class PersonForm
{
    protected const TemplatePath = __DIR__.'/../Templates/person.json';

    protected $form;
    protected $company;

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

    public function company($company)
    {
        $this->company = $company;

        return $this;
    }
}
