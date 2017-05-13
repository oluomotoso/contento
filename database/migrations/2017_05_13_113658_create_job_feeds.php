<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobFeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('industry')->nullable();
            $table->text('position')->nullable();
            $table->text('location')->nullable();
            $table->text('company')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('link');
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
        Schema::table('job_feeds', function (Blueprint $table) {
            $table->dropForeign('job_feeds_datasource_feed_id_foreign');

        });
        Schema::dropIfExists('job_feeds');
    }
}
