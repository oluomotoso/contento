<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountToPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->integer('discount')->unsigned();
            $table->integer('month')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('month');
            $table->dropColumn('discount');
        });
    }
}
