<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CartConditions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conditions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('conditionable_id')->unsigned();
            $table->string('conditionable_type');
            $table->string('name');
            $table->string('type');
            $table->string('target');
            $table->float('value');
            $table->text('attributes');
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
        Schema::drop('conditions');
    }
}
