<?php

namespace LaravelEnso\Companies;

use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\Searchable\SearchServiceProvider as ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    public $register = [
        Company::class => [
            'group' => 'Company',
            'attributes' => ['name'],
            'label' => 'name',
            'permissionGroup' => 'administration.companies',
        ],
    ];
}
