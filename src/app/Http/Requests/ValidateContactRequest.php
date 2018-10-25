<?php

namespace LaravelEnso\Companies\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
}
