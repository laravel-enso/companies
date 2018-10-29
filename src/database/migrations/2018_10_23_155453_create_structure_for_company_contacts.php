<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForCompanyContacts extends StructureMigration
{
    protected $permissions = [
        ['name' => 'administration.companies.contacts.options', 'description' => 'Get options for select', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.companies.contacts.create', 'description' => 'Create company contact', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.contacts.edit', 'description' => 'Edit existing company contact', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.contacts.index', 'description' => 'Show companies', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.companies.contacts.store', 'description' => 'Store newly created company contact', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.contacts.update', 'description' => 'Update edited company contact', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.contacts.destroy', 'description' => 'Delete company contact', 'type' => 1, 'is_default' => false],
    ];
}
