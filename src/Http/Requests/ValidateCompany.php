<?php

namespace LaravelEnso\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use LaravelEnso\Companies\Enums\Statuses;
use LaravelEnso\Helpers\Traits\FiltersRequest;

class ValidateCompany extends FormRequest
{
    use FiltersRequest;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mandatary' => 'nullable|exists:people,id',
            'name' => ['required', 'string', $this->unique('name')],
            'status' => 'required|numeric|in:'.Statuses::keys()->implode(','),
            'fiscal_code' => ['string', 'nullable', $this->unique('fiscal_code')],
            'reg_com_nr' => ['string', 'nullable', $this->unique('reg_com_nr')],
            'email' => 'email|nullable',
            'phone' => 'nullable',
            'fax' => 'nullable',
            'website' => 'nullable|url',
            'bank' => 'string|nullable',
            'bank_account' => 'string|nullable',
            'notes' => 'string|nullable',
            'pays_vat' => 'required|boolean',
            'is_tenant' => 'required|boolean',
            'is_public_institution' => 'required|boolean',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled('mandatary') && $this->mandataryIsNotAssociated()) {
                $validator->errors()
                    ->add('mandatary', __('The selected person is not associated to this company'));
            }

            if ($this->filled('fiscal_code') && $this->invalidFiscalCode()) {
                $validator->errors()
                    ->add('fiscal_code', __('Invalid fiscal code'));
            }
        });
    }

    protected function mandataryIsNotAssociated()
    {
        return ! $this->route('company')->people()
            ->pluck('id')->contains($this->get('mandatary'));
    }

    protected function unique(string $attribute)
    {
        return Rule::unique('companies', $attribute)
            ->ignore($this->route('company')?->id);
    }

    protected function invalidFiscalCode(): bool
    {
        return Str::of($this->get('fiscal_code'))->lower()
            ->ltrim('ro')
            ->startsWith('0');
    }
}
