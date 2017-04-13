<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feed_id')->unsigned();
            $table->foreign('feed_id')->references('id')->on('datasources_feeds');
            $table->integer('subscription_id')->unsigned();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');//
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_feeds', function (Blueprint $table) {
            $table->dropForeign('subscription_datasources_feeds_feed_id_foreign');
            $table->dropForeign('subscription_feeds_subscription_id_foreign');

        });
        Schema::dropIfExists('subscription_feeds');
    }
}
