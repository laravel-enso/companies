<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Models\Company;

class Destroy extends Controller
{
    public function __invoke(Company $company)
    {
        $company->delete();

        return [
            'message' => __('The company was successfully deleted'),
            'redirect' => 'administration.companies.index',
        ];
    }
}
