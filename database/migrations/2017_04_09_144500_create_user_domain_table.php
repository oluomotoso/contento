<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDomainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_domains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->string('domain_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('platform_id')->unsigned()->nullable();
            $table->integer('api_data_id')->unsigned()->nullable();
            $table->foreign('api_data_id')->references('id')->on('api_datas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_domains', function (Blueprint $table) {
            $table->dropForeign('user_domains_user_id_foreign');
            $table->dropForeign('user_domains_api_data_id_foreign');
            $table->dropColumn('api_data_id');
        });
        Schema::dropIfExists('user_domains');
    }
}
