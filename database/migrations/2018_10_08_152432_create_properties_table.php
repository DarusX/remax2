<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->string('availability');
            $table->text('name');
            $table->text('description');
            $table->string('neighborhood');
            $table->text('address');
            $table->double('lat');
            $table->double('lng');
            $table->string('currency');
            $table->double('price');
            $table->string('type');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
