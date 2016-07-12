<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function(Blueprint $table)
        {
            $table->string('bank')->nullable();
            $table->boolean('nds')->default(false);
            $table->integer('invoice_days')->nullable();
            $table->string('stamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function(Blueprint $table)
        {
            $table->dropColumn('bank');
            $table->dropColumn('nds');
            $table->dropColumn('invoice_days');
            $table->dropColumn('stamp');
        });
    }
}
