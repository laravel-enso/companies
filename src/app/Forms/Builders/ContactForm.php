<?php

namespace LaravelEnso\Companies\app\Forms\Builders;

use Illuminate\Support\Facades\File;
use LaravelEnso\Companies\app\Models\Contact;
use LaravelEnso\FormBuilder\app\Classes\Form;

class ContactForm
{
    private const TemplatePath = __DIR__.'/../Templates/contact.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form($this->templatePath());
    }

    public function create()
    {
        return $this->form
            ->actions('store')
            ->create();
    }

    public function edit(Contact $contact)
    {
        return $this->form
            ->actions('update')
            ->edit($contact);
    }

    private function templatePath()
    {
        $file = config('enso.companies.contactFormTemplate');
        $templatePath = base_path($file);

        return $file && File::exists($templatePath)
            ? $templatePath
            : self::TemplatePath;
    }
}
