<?php

namespace LaravelEnso\Companies\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LaravelEnso\Companies\app\Enums\CompanyStatuses;

class ValidateCompanyRequest extends FormRequest
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
            'status' => 'required|numeric|in:'.CompanyStatuses::keys()->implode(','),
            'fiscal_code' => ['string', 'nullable', $this->fiscalCodeUnique()],
            'reg_com_nr' => ['string', 'nullable', $this->regComNrUnique()],
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
        if ($this->filled('mandatary') && $this->mandataryIsNotAssociated()) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'mandatary',
                    __('The selected person is not associated to this company')
                );
            });
        }
    }

    protected function mandataryIsNotAssociated()
    {
        return ! $this->route('company')->people()
            ->pluck('id')->contains($this->get('mandatary'));
    }

    protected function nameUnique()
    {
        return Rule::unique('companies', 'name')
            ->ignore(optional($this->route('company'))->id);
    }

    protected function fiscalCodeUnique()
    {
        return Rule::unique('companies', 'fiscal_code')
            ->ignore(optional($this->route('company'))->id);
    }

    protected function regComNrUnique()
    {
        return Rule::unique('companies', 'reg_com_nr')
            ->ignore(optional($this->route('company'))->id);
    }
}
