<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_domains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->integer('subscription_id')->unsigned();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->string('website_type')->default('wordpress');
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
        Schema::table('subscription_domains', function (Blueprint $table) {
            $table->dropForeign('subscription_domains_subscription_id_foreign');
        });
        Schema::dropIfExists('subscription_domains');
    }
}
