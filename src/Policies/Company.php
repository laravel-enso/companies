<?php

namespace LaravelEnso\Companies\Policies;

use LaravelEnso\Companies\Models\Company as Model;
use LaravelEnso\Users\Models\User;

class Company
{
    public function before(User $user)
    {
        return $user->isSuperior();
    }

    public function store(User $user, Model $model)
    {
        return true;
    }

    public function update(User $user, Model $model)
    {
        return true;
    }

    public function destroy(User $user, Model $model)
    {
        return true;
    }

    public function managePeople(User $user, Model $model)
    {
        return true;
    }
}
