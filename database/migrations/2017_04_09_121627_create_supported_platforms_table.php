<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportedPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('platform')->unique();
            $table->timestamps();
        });
        Schema::table('subscription_domains', function (Blueprint $table) {
             $table->integer('platform_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_domains', function (Blueprint $table) {
            $table->dropColumn('platform_id');
        });

        Schema::dropIfExists('platforms');
    }
}
