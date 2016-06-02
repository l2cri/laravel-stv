<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BoxberryCourierZips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxberry_courier_zips', function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('zip');
            $table->string('city');
            $table->string('area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('boxberry_courier_zips');
    }
}
