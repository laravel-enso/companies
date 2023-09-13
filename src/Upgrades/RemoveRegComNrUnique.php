<?php

namespace App\Upgrades;

use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class RemoveRegComNrUnique implements MigratesTable
{
    public function isMigrated(): bool
    {
        return ! Table::hasIndex('companies', 'companies_reg_com_nr_unique');
    }

    public function migrateTable(): void
    {
        Schema::table('companies', function ($table) {
            $table->dropUnique('companies_reg_com_nr_unique');
        });
    }
}
