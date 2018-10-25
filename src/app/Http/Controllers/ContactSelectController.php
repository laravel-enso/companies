<?php

namespace LaravelEnso\Companies\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Contact;
use LaravelEnso\Select\app\Traits\OptionsBuilder;

class ContactSelectController extends Controller
{
    use OptionsBuilder;

    protected $model = Contact::class;
}
