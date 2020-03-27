<?php

namespace LaravelEnso\Companies\App\Policies;

use LaravelEnso\Companies\App\Models\Company as Model;
use LaravelEnso\Core\App\Models\User;

class Company
{
    public function before(User $user)
    {
        if ($user->isAdmin() || $user->isSupervisor()) {
            return true;
        }
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
