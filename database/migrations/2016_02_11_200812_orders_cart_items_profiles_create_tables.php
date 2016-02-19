<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersCartItemsProfilesCreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->default('Профиль по умолчанию');
            $table->string('person');
            $table->string('phone');
            $table->text('address');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users'); // при удалении пользователя
            // оставляем профили, так как от них зависят уже сделанные заказы и вся статистика

            // TODO: добавить location_id и company_id
            $table->timestamps();
        });

        Schema::create('orders', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->float('subtotal')->default(0); // без скидок
            $table->float('total')->default(0); // со всеми скидками
            $table->text('comment')->nullable();
            //TODO: добавить delivery_id и delivery_price, payment_id, оплачен или нет, статус заказа,
            // возможность добавлять статусы
            // возвраты: return=yes - может быть, returned_id - id возвращаемого заказа, return_id - заказ-возврат данного,
            // с такой схемой будет возможен частичный возврат, в том числе например одной еденицы товара из оптовой партии
            // если их заказали например 50, а одна бракована
            $table->timestamps();
        });

        Schema::create('cart_items', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->float('price')->default(0); // цена, которая по-умолчанию для товара стоит
            $table->float('final_price')->default(0); // цена со всеми скидками Conditions
            $table->float('subtotal')->default(0); // без скидок
            $table->float('total')->default(0); // со всеми скидками
            $table->string('name');
            $table->integer('quantity');
            $table->text('attributes')->nullable(); // размеры, свойства, поставщика можно записать, чтобы легче было вытащить инфу
            $table->text('comment')->nullable(); // если цену поменяли или обнулили - написать можно комментарий, что например под замену
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
        Schema::drop('cart_items');
        Schema::drop('orders');
        Schema::drop('profiles');
    }
}
