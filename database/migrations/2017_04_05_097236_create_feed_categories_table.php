<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feed_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('feed_id')->references('id')->on('feeds');
            $table->foreign('category_id')->references('id')->on('categories');
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
            $table->dropForeign('feed_categories_category_id_foreign');
        });
        Schema::dropIfExists('feed_categories');
    }
}
