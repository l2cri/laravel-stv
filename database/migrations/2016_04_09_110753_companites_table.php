<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('supplier_id')->unsigned()->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->string('name');
            $table->string('ogrn')->nullable();
            $table->string('inn')->nullable();
            $table->string('kpp')->nullable();
            $table->string('rs')->nullable();
            $table->string('ks')->nullable();
            $table->string('ceo')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('law_address')->nullable();
            $table->text('fact_address')->nullable();
            $table->timestamps();
        });

        Schema::table('profiles', function(Blueprint $table)
        {
            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('companies');
        Schema::table('profiles', function(Blueprint $table)
        {
            $table->dropColumn('company_id');
        });
    }
}