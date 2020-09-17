<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_orders', function (Blueprint $table) {
            $table->id();
            $table->double('price', 15, 2);
            $table->boolean('landlord_confirmation');
            $table->boolean('tenant_confirmation');
            $table->date('date_start');
            $table->date('date_end');
            $table->enum('status', ['Создан', "Принят", 'Утверждён', 'Выполнен', 'Отменён', 'Отозван']);
            $table->enum('read_status', ['Прочитано', 'Непрочитано'])->default('Непрочитано');
            $table->foreignId('tenant_id')->unsigned();
            $table->foreignId('flat_id')->unsigned();
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('users');
            $table->foreign('flat_id')->references('id')->on('flats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flat_orders');
    }
}
