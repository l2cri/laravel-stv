<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->integer('rating');
            $table->morphs('rateable');
            $table->unsignedInteger('user_id')->index();
            $table->index('rateable_id');
            $table->index('rateable_type');
            $table->foreign('user_id')->references('id')->on('users');
        });

        if(!Schema::hasColumn('products', 'rating'))
        {
            Schema::table('products', function(Blueprint $table)
            {
                $table->float('rating')->nullable();
            });
        }

        if(!Schema::hasColumn('suppliers', 'rating'))
        {
            Schema::table('suppliers', function(Blueprint $table)
            {
                $table->float('rating')->nullable();
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {

        Schema::table('products', function(Blueprint $table)
        {
            $table->dropColumn('rating');
        });
        Schema::table('suppliers', function(Blueprint $table)
        {
            $table->dropColumn('rating');
        });
        Schema::drop('ratings');
    }
}
