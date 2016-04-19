<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasColumn('banners', 'type'))
        {
            Schema::table('banners', function(Blueprint $table)
            {
                $table->string('type')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('banners', function(Blueprint $table)
        {
            $table->dropColumn('type');
        });
    }
}
