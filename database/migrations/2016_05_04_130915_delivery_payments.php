<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeliveryPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * type - класс обработчика, полный путь с namespace для инициализации в контейнере,
         * должен быть общий интерфейс для разных доставок и разных оплат
         *
         * settings - сериализованный массив с настройками,
         * в админке в зависимости от типа type будут подключаться разные view по ajax для обработки настроек,
         * генерация вьюшки и обработки должны быть в интерфейсах и реализациях
         *
         * в будушем добавить отношение morph модели Order к Conditions и записывать туда скидки или наоборот
         * наценки на заказ, записывать будут обработчики служб доставки и оплаты
         * (например +стоимость доставки или -скидка за онлайн-оплату)
         */

        Schema::create('deliveries', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active')->default(true);
            $table->string('name');
            $table->text('
            ')->nullable();
            $table->text('settings')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::create('payments', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active')->default(true);
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('settings')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::table('orders', function(Blueprint $table)
        {
            $table->integer('delivery_id')->unsigned()->nullable();
            $table->foreign('delivery_id')->references('id')->on('deliveries');

            $table->integer('payment_id')->unsigned()->nullable();
            $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deliveries');
        Schema::drop('payments');
        Schema::table('orders', function(Blueprint $table)
        {
            $table->dropColumn('delivery_id');
            $table->dropColumn('payment_id');
        });
    }
}
