<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseholdServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('household_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('city');
            $table->text('description');
            $table->double('price', 15, 2);
            $table->foreignId('user_id')->unsigned();
            $table->foreignId('household_service_category_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('household_service_category_id')->references('id')->on('household_service_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('household_services');
    }
}
