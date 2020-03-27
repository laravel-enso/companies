<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Company;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Http\Requests\ValidateCompanyRequest;
use LaravelEnso\Companies\App\Models\Company;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateCompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);

        tap($company)->update($request->validated())
            ->updateMandatary($request->get('mandatary'));

        return ['message' => __('The company was successfully updated')];
    }
}
