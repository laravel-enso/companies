<?php

namespace LaravelEnso\Companies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use LaravelEnso\Companies\Enums\Statuses;
use LaravelEnso\Companies\Models\Company;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name' => null,
            'fiscal_code' => null,
            'reg_com_nr' => null,
            'email' => null,
            'phone' => null,
            'fax' => null,
            'bank' => null,
            'bank_account' => null,
            'website' => null,
            'notes' => null,
            'pays_vat' => true,
            'is_public_institution' => false,
            'status' => Statuses::Active,
        ];
    }

    public function test()
    {
        return $this->state(fn () => [
            'name' => $this->faker->unique()->company,
            'fiscal_code' => Str::of($this->faker->ean8)->ltrim('0')->__toString(),
            'reg_com_nr' => $this->faker->ean13,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'fax' => $this->faker->phoneNumber,
            'bank' => $this->faker->company,
            'bank_account' => $this->faker->bankAccountNumber,
            'notes' => $this->faker->sentence,
            'pays_vat' => $this->faker->boolean,
            'is_public_institution' => $this->faker->boolean,
            'status' => Statuses::keys()->random(),
        ]);
    }
}
