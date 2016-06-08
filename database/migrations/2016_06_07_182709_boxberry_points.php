<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BoxberryPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxberry_points_cities', function(Blueprint $table){

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('country_code')->nullable();
            $table->integer('location_id')->index();
        });

        Schema::create('boxberry_points', function(Blueprint $table){

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->text('work_schedule')->nullable();
            $table->text('trip_description')->nullable();
            $table->integer('delivery_period')->nullable();
            $table->string('city_code');
            $table->string('city_name')->nullable();
            $table->string('tarif_zone')->nullable();
            $table->string('settlement')->nullable();
            $table->string('area')->nullable();
            $table->string('country')->nullable();
            $table->string('only_prepaid_orders')->nullable();
            $table->string('address_reduce')->nullable();
            $table->string('acquiring')->nullable();
            $table->string('digital_signature')->nullable();
            $table->string('office_type')->nullable();
            $table->string('nal_kd')->nullable();
            $table->string('metro')->nullable();
            $table->string('gps')->nullable();


            $table->integer('bpc_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('boxberry_points_cities');
        Schema::drop('boxberry_points');
    }
}
