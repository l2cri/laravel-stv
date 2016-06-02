<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BoxberryCourier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxberry_courier_cities', function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('location_id')->unsigned()->index();
            $table->string('name');
            $table->smallInteger('time')->insigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('boxberry_courier_cities');
    }
}