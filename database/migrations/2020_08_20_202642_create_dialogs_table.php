<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDialogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialogs', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Обычный', 'Квартира', 'Робота', 'Поддержка']);
            $table->foreignId('first_user_id')->unsigned();
            $table->foreignId('second_user_id')->unsigned();
            $table->foreignId('flat_order_id')->unsigned()->nullable();
            $table->foreignId('household_service_order_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('first_user_id')->references('id')->on('users');
            $table->foreign('second_user_id')->references('id')->on('users');
            $table->foreign('flat_order_id')->references('id')->on('flat_orders');
            $table->foreign('household_service_order_id')->references('id')->on('household_service_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dialogs');
    }
}
