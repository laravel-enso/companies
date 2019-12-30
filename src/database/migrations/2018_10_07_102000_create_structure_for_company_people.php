<?php

use LaravelEnso\Migrator\App\Database\Migration;
use LaravelEnso\Permissions\App\Enums\Types;

class CreateStructureForCompanyPeople extends Migration
{
    protected $permissions = [
        ['name' => 'administration.companies.people.create', 'description' => 'Add person to company', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'administration.companies.people.edit', 'description' => 'Edit existing company person', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'administration.companies.people.index', 'description' => 'Show company people', 'type' => Types::Read, 'is_default' => false],
        ['name' => 'administration.companies.people.store', 'description' => 'Save newly added company person', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'administration.companies.people.update', 'description' => 'Update edited company person', 'type' => Types::Write, 'is_default' => false],
        ['name' => 'administration.companies.people.destroy', 'description' => 'Delete company person', 'type' => Types::Write, 'is_default' => false],
    ];
}
