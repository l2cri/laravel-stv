<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class LocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('regioncode')->nullable();
            $table->string('aoguid')->nullable();
            $table->string('parentguid')->nullable();
            $table->string('aoid')->nullable();
            $table->string('level')->nullable();
            $table->string('shortname')->nullable();
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
        Schema::drop('locations');
    }
}
