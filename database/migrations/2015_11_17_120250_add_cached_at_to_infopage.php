<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCachedAtToInfopage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('infopages', function(Blueprint $table)
        {
            $table->timestamp('cached_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('infopages', function(Blueprint $table)
        {
            $table->dropColumn('cached_at');
        });
    }
}
