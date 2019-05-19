<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Company;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Companies\app\Http\Requests\ValidateCompanyUpdate;

class Update extends Controller
{
    public function __invoke(ValidateCompanyUpdate $request, Company $company)
    {
        $company->update($request->validated());

        $mandatary = $company->mandatary();

        if (! $request->filled('mandatary') && $mandatary !== null) {
            $company->removeMandatary($mandatary->id);
        }

        if ($request->filled('mandatary')
            && $request->get('mandatary') !== optional($mandatary)->id) {
            if ($mandatary !== null) {
                $company->removeMandatary($mandatary->id);
            }

            $company->setMandatary($request->get('mandatary'));
        }

        return ['message' => __('The company was successfully updated')];
    }
}
