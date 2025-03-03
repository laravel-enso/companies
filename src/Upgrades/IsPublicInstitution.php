<?php

namespace LaravelEnso\Companies\Upgrades;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class IsPublicInstitution implements MigratesTable
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('companies', 'is_public_institution');
    }

    public function migrateTable(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->boolean('is_public_institution')->default(false)
                ->after('is_tenant');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->boolean('is_public_institution')->default(null)->change();
        });
    }
}
