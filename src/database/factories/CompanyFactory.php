<?php

use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'mandatary_id' => function () {
            return factory(Company::class)->create()->id;
        },
        'name' => $faker->company,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'fax' => $faker->faxNumber,
        'mandatary_position' => $faker->jobTitle,
        'bank' => $faker->company,
        'account' => $faker->bank_account,
        'obs' => $faker->sentence,
        'pays_vat' => $faker->boolean,
    ];
});
