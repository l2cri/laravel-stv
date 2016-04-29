<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsImagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active')->default(true);
            $table->boolean('moderated')->default(false);
            $table->boolean('available')->default(true);
            $table->boolean('featured')->default(false);
            $table->string('name');
            $table->string('articul')->nullable();
            $table->string('barcode')->nullable();
            $table->string('unit')->nullable(); // еденица измерения
            $table->integer('length')->default(0); //мм
            $table->integer('width')->default(0); //мм
            $table->integer('height')->default(0); //мм
            $table->integer('weight')->default(0); //грамм
            $table->integer('volume')->default(0); //объем мл
            $table->float('price')->default(0);
            $table->float('regular_price')->default(0);
            $table->float('action_price')->default(0);
            $table->float('whosale_price')->default(0);
            $table->integer('whosale_quantity')->default(0); // кол-во товаров для продажи оптом
            $table->text('preview')->nullable();
            $table->text('description')->nullable();
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers'); // не будем каскадно удалять
            $table->timestamps();
        });

        Schema::create('photos', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('file');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('product_section', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_section');
        Schema::drop('photos');
        Schema::drop('products');
    }
}
