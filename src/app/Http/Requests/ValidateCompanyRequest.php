<?php

namespace LaravelEnso\Companies\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Companies\app\Contracts\ValidatesCompanyRequest;

class ValidateCompanyRequest extends FormRequest implements ValidatesCompanyRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $nameUnique = Rule::unique('companies', 'name');

        if ($this->method() === 'PATCH') {
            $nameUnique = $nameUnique->ignore($this->route('company')->id);
        }

        return [
            'mandatary_id' => 'nullable|exists:people,id',
            'name' => ['required', 'string', $nameUnique],
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
