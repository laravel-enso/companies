<?php

namespace LaravelEnso\Companies\App\Imports\Importers;

use LaravelEnso\Companies\App\Models\Company as Model;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\DataImport\App\Contracts\Importable;
use LaravelEnso\Helpers\App\Classes\Obj;

class Company implements Importable
{
    public function run(Obj $row, User $user, Obj $params)
    {
        $this->import($row);
    }

    private function import($row)
    {
        factory(Model::class)->create($row->toArray());
    }
}
