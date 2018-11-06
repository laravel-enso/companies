<?php

namespace LaravelEnso\Companies\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Contact;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class ContactSelectController extends Controller
{
    use OptionsBuilder;

    protected $queryAttributes = ['person.name', 'person.appellative', 'position'];

    protected $model = Contact::class;
}
