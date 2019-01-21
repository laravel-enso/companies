<?php

namespace LaravelEnso\Companies\app\Forms\Builders;

use LaravelEnso\People\app\Models\Person;
use LaravelEnso\FormBuilder\app\Classes\Form;

class PersonForm
{
    private const TemplatePath = __DIR__.'/../Templates/person.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::TemplatePath);
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
            ->actions('update')
            ->edit($person);
    }
}
