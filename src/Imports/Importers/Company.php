<?php

namespace LaravelEnso\Companies\Imports\Importers;

use LaravelEnso\Companies\Models\Company as Model;
use LaravelEnso\DataImport\Contracts\Importable;
use LaravelEnso\DataImport\Models\DataImport;
use LaravelEnso\Helpers\Services\Obj;

class Company implements Importable
{
    public function run(Obj $row, DataImport $import)
    {
        $this->import($row);
    }

    private function import($row)
    {
        (Model::class)::factory()->create($row->toArray());
    }
}
