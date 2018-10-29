<?php

namespace LaravelEnso\Companies\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Companies\app\Models\Contact;
use LaravelEnso\Companies\app\Contracts\ValidatesContactRequest;

class ValidateContactRequest extends FormRequest implements ValidatesContactRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'person_id' => 'required|exists:people,id',
            'position' => 'string|nullable',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->method() === 'POST' && $this->contactExists()) {
                $validator->errors()
                    ->add('person_id', 'The selected person is already a contact of this company');
            }
        });
    }

    private function contactExists()
    {
        return Contact::whereCompanyId($this->get('company_id'))
            ->wherePersonId($this->get('person_id'))
            ->count() > 0;
    }
}
