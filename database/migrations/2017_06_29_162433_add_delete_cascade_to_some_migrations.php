<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteCascadeToSomeMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feed_categories', function (Blueprint $table) {
            $table->dropForeign('feed_categories_feed_id_foreign');
            $table->foreign('feed_id')->references('id')->on('feeds')->onDelete('cascade');

        });
        Schema::table('Published_feeds', function (Blueprint $table) {
            $table->dropForeign('Published_feeds_feed_id_foreign');
            $table->foreign('feed_id')->references('id')->on('feeds')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feed_categories', function (Blueprint $table) {
            $table->dropForeign('feed_categories_feed_id_foreign');
            $table->foreign('feed_id')->references('id')->on('feeds');

        });
        Schema::table('Published_feeds', function (Blueprint $table) {
            $table->dropForeign('Published_feeds_feed_id_foreign');
            $table->foreign('feed_id')->references('id')->on('feeds');

        });
    }
}
