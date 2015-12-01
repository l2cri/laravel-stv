<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleAbility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // таблицы роли - возможности - пивот роль-юзер - пивот роль-возможность
        Schema::create('roles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('abilities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->default('');
            $table->string('action')->default('');
            $table->timestamps();
        });

        Schema::create('role_user', function(Blueprint $table){
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('ability_role', function(Blueprint $table){
            $table->integer('ability_id')->unsigned();
            $table->foreign('ability_id')->references('id')->on('abilities')->onDelete('cascade');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        // метка админ прямо в таблице юзеров - чтобы сразу было понятно что есть доступ к любому модулю
        Schema::table('users', function(Blueprint $table)
        {
            $table->boolean('admin')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('admin');
        });
        Schema::drop('roles');
        Schema::drop('abilities');
        Schema::drop('role_user');
        Schema::drop('ability_role');
    }
}
