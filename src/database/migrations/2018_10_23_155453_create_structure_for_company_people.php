<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForCompanyPeople extends StructureMigration
{
    protected $permissions = [
        ['name' => 'administration.companies.people.create', 'description' => 'Add person to company', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.people.index', 'description' => 'Show company people', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.companies.people.store', 'description' => 'Save newly added company person', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.people.update', 'description' => 'Update edited company person', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.people.destroy', 'description' => 'Delete company person', 'type' => 1, 'is_default' => false],
    ];
}
