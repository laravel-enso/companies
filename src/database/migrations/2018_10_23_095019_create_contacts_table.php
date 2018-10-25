<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->integer('person_id')->unsigned()->index();
            $table->foreign('person_id')->references('id')->on('people');

            $table->string('position')->nullable();

            $table->unique(['company_id', 'person_id', 'position']);

            $table->timestamps();

            $table->integer('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->integer('updated_by')->unsigned()->index()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
