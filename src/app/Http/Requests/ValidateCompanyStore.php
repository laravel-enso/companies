<?php

namespace LaravelEnso\Companies\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Companies\app\Enums\CompanyStatuses;

class ValidateCompanyStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mandatary' => 'nullable|exists:people,id',
            'name' => ['required', 'string', $this->nameUnique()],
            'status' => 'nullable|numeric|in:'.CompanyStatuses::keys()->implode(','),
            'fiscal_code' => 'string|nullable',
            'reg_com_nr' => 'string|nullable',
            'email' => 'email|nullable',
            'phone' => 'nullable',
            'fax' => 'nullable',
            'bank' => 'string|nullable',
            'bank_account' => 'string|nullable',
            'obs' => 'string|nullable',
            'pays_vat' => 'required|boolean',
            'is_tenant' => 'required|boolean',
        ];
    }

    public function withValidator($validator)
    {
        if ($this->filled('mandatary') && ! $this->mandataryIsAssociated()) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'mandatary',
                    __('The selected person is not associated to this company')
                );
            });
        }
    }

    protected function mandataryIsAssociated()
    {
        return $this->route('company')->people()
            ->pluck('id')
            ->contains($this->get('mandatary'));
    }

    protected function nameUnique()
    {
        return Rule::unique('companies', 'name');
    }
}
