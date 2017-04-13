<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PublishedFeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Published_feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feed_id')->unsigned();
            $table->foreign('feed_id')->references('id')->on('feeds');
            $table->integer('subscription_id')->unsigned();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');//
            $table->integer('domain_id')->unsigned();
            $table->foreign('domain_id')->references('id')->on('Subscription_domains');//
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
        Schema::table('Published_feeds', function (Blueprint $table) {
            $table->dropForeign('Published_feeds_feed_id_foreign');
            $table->dropForeign('Published_feeds_subscription_id_foreign');
            $table->dropForeign('Published_feeds_domain_id_foreign');

        });
        Schema::dropIfExists('Published_feeds');
    }
}
