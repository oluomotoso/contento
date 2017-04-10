<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApiDataIdToSubscriptionDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_domains', function (Blueprint $table) {
            $table->integer('api_data_id')->unsigned()->nullable();
            $table->foreign('api_data_id')->references('id')->on('api_datas');
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
            $table->dropForeign('subscription_domains_api_data_id_foreign');
            $table->dropColumn('api_data_id');
        });
    }
}
