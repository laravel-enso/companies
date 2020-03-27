<?php

namespace LaravelEnso\Companies\App\Http\Controllers\Person;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Companies\App\Http\Requests\ValidatePersonUpdate;
use LaravelEnso\Companies\App\Models\Company;
use LaravelEnso\People\App\Models\Person;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidatePersonUpdate $request, Person $person)
    {
        $company = Company::find($request->get('company_id'));

        $this->authorize('manage-people', $company);

        $person->companies()->updateExistingPivot(
            $company->id, $request->only('position')
        );

        return ['message' => __('The person has been successfully updated')];
    }
}
