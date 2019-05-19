<?php

namespace LaravelEnso\Companies\app\Http\Requests;

use LaravelEnso\People\app\Models\Person;

class ValidatePersonStore extends ValidatePersonUpdate
{
    public function withValidator($validator)
    {
        if ($this->personExists()) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'id', __('The selected person is already associated to this company')
                );
            });
        }
    }

    private function personExists()
    {
        return Person::whereId($this->get('id'))
            ->whereHas('companies', function ($companies) {
                $companies->whereId($this->get('company_id'));
            })->first() !== null;
    }
}
