<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('house_number');
            $table->text('description');
            $table->integer('floor');
            $table->integer('area');
            $table->integer('living_area');
            $table->integer('number_of_rooms');
            $table->string('city');
            $table->enum('type_of_premises', ['Частный дом', 'Квартира', 'Комната']);
            $table->enum('rental_period', ['Посуточно', 'Помесячно']);
            $table->double('price', 15, 2);
            $table->string('photos')->default('["flats\\default.png"]');
            $table->foreignId('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flats');
    }
}
