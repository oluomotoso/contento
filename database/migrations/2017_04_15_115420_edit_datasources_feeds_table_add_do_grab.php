<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditDatasourcesFeedsTableAddDoGrab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datasources_feeds', function (Blueprint $table) {
            $table->boolean('do_grab')->default(false);
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
            $table->dropColumn('do_grab');
        });
    }
}
