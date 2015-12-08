<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // таблица с поставщиком или магазином или компании по услугам
        // внешний ключ на профиль ООО добавим позже
        Schema::create('suppliers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->text('conditions');
            $table->text('responsibility');
            $table->integer('whosale_order')->default(0);  // сумма заказа от для оптовой цены
            $table->integer('whosale_quantity')->default(0); // кол-во одного товара для оптовой цены
            $table->string('color');
            $table->string('logo'); // название файла в папке с логотипами, путь к папке будем задавать
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suppliers');
    }
}
