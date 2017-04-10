<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDomainIdToSubscriptionDomains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_domains', function (Blueprint $table) {
            $table->integer('user_domain_id')->unsigned();
            $table->foreign('user_domain_id')->references('id')->on('user_domains');
            $table->dropColumn('url');
            $table->dropForeign('subscription_domains_api_data_id_foreign');
            $table->dropColumn('api_data_id');
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
            $table->dropForeign('subscription_domains_user_domain_id_foreign');
            $table->dropColumn('user_domain_id');
            $table->string('url');
            $table->integer('api_data_id')->unsigned()->nullable();
            $table->foreign('api_data_id')->references('id')->on('api_datas');

        });
    }
}
