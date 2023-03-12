<?php

namespace LaravelEnso\Companies\Imports\Importers;

use LaravelEnso\Companies\Models\Company as Model;
use LaravelEnso\DataImport\Contracts\Importable;
use LaravelEnso\DataImport\Models\Import;
use LaravelEnso\Helpers\Services\Obj;

class Company implements Importable
{
    public function run(Obj $row, Import $import)
    {
        $this->import($row);
    }

    private function import($row)
    {
        Model::factory()->create($row->toArray());
    }
}
