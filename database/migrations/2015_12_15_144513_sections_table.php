<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class SectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Категории в каталоге, отношение многи ко многим и таблицу-пивот добавим позже

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable(); // если создано из админки, то user_id не нужен
            $table->foreign('user_id')->references('id')->on('users');
            //$table->integer('parent_id')->nullable();
            $table->string('name');
            $table->string('code')->nullable(); // при создании категории из панели поставщика код не нужен
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('moderated')->default(false);
            $table->timestamps();


            NestedSet::columns($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sections');
    }
}
