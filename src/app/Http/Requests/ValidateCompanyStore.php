<?php

namespace LaravelEnso\Companies\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateCompanyStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mandatary_id' => 'nullable|exists:people,id',
            'name' => ['required', 'string', $this->nameUnique()],
            'email' => 'email|nullable',
            'phone' => 'nullable',
            'fax' => 'nullable',
            'bank' => 'string|nullable',
            'bank_account' => 'string|nullable',
            'obs' => 'string|nullable',
            'pays_vat' => 'required|boolean',
            'is_tenant' => 'required|boolean'
        ];
    }

    public function withValidator($validator)
    {
        if ($this->filled('mandatary_id') && ! $this->mandataryIsAssociated()) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'mandatary_id',
                    __('The selected person is not associated to this company')
                );
            });
        }
    }

    protected function mandataryIsAssociated()
    {
        return $this->route('company')->people()
            ->pluck('id')
            ->contains($this->get('mandatary_id'));
    }

    protected function nameUnique()
    {
        return Rule::unique('companies', 'name');
    }
}
