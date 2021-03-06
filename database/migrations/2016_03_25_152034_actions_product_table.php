<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActionsProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            //
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->boolean('active')->nullable();
            $table->string('name');
            $table->text('description');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->integer('percent')->nullable();
            $table->float('static')->nullable();
            $table->timestamps();
        });

        Schema::table('products', function(Blueprint $table)
        {
            $table->integer('action_id')->unsigned()->nullable();
            $table->foreign('action_id')->references('id')->on('actions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(Blueprint $table)
        {
            $table->dropColumn('action_id');
        });
        Schema::drop('actions');
    }
}
