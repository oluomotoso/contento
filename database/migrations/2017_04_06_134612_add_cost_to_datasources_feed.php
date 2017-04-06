<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostToDatasourcesFeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datasources_feeds', function (Blueprint $table) {
            $table->decimal('cost', 10, 2)->default(5);
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
            $table->dropColumn('cost');
        });
    }
}
