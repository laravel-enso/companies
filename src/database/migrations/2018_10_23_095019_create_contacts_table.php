<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Artisan::call('enso:companies:clean-morphable-contacts');

        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->integer('person_id')->unsigned()->index();
            $table->foreign('person_id')->references('id')->on('people');

            $table->string('position')->nullable();

            $table->unique(['company_id', 'person_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
