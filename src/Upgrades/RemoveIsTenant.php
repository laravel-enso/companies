<?php

namespace LaravelEnso\Companies\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class RemoveIsTenant implements MigratesTable
{
    public function isMigrated(): bool
    {
        return ! Table::hasColumn('companies', 'is_tenant');
    }

    public function migrateTable(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('is_tenant');
        });
    }
}
