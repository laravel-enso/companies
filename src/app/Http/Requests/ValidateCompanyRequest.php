<?php

namespace LaravelEnso\Companies\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mandatary_id' => 'nullable|exists:people,id',
            'name' => 'required|string',
            'email' => 'email|nullable',
            'phone' => 'nullable',
            'fax' => 'nullable',
            'mandatary_position' => 'string|nullable',
            'bank' => 'string|nullable',
            'bank_account' => 'string|nullable',
            'obs' => 'string|nullable',
            'pays_vat' => 'required|boolean',
        ];
    }
}
