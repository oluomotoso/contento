<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasourcesFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasources_feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('datasource_id')->unsigned();
            $table->foreign('datasource_id')->references('id')->on('datasources');
            $table->boolean('status')->default(false);
            $table->string('url')->unique();
            $table->string('last_modified')->nullable();
            $table->string('etag')->nullable();
            $table->timestamps();

            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datasources_feeds', function (Blueprint $table) {
            $table->dropForeign('datasources_feeds_datasource_id_foreign');

        });
        Schema::dropIfExists('datasources_feeds');

    }
}
