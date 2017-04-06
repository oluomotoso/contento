<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('grabbed_content')->nullable();
            $table->string('link')->unique();
            $table->integer('datasource_feed_id')->unsigned();
            $table->foreign('datasource_feed_id')->references('id')->on('datasources_feeds');
            $table->timestamp('published_date');
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
        Schema::table('feeds', function (Blueprint $table) {
            $table->dropForeign('feeds_datasource_feed_id_foreign');

        });
        Schema::dropIfExists('feeds');

    }
}
