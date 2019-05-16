<?php

use LaravelEnso\Migrator\app\Database\Migration;

class CreateStructureForCompanies extends Migration
{
    protected $permissions = [
        ['name' => 'administration.companies.initTable', 'description' => 'Init table for companies', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.companies.tableData', 'description' => 'Get table data for companies', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.companies.exportExcel', 'description' => 'Export excel for companies', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.companies.options', 'description' => 'Get options for select', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.companies.create', 'description' => 'Create company', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.edit', 'description' => 'Edit existing company', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.index', 'description' => 'Show companies', 'type' => 0, 'is_default' => false],
        ['name' => 'administration.companies.store', 'description' => 'Store newly created company', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.update', 'description' => 'Update edited company', 'type' => 1, 'is_default' => false],
        ['name' => 'administration.companies.destroy', 'description' => 'Delete company', 'type' => 1, 'is_default' => false],
    ];

    protected $menu = [
        'name' => 'Companies', 'icon' => 'building', 'route' => 'administration.companies.index', 'order_index' => 250, 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}
