<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditApiDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api_datas', function (Blueprint $table) {
            $table->text('refresh_token')->nullable()->change();
            $table->text('token')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api_datas', function (Blueprint $table) {
            $table->string('refresh_token')->nullable()->change();
            $table->string('token')->nullable()->change();
        });
    }
}
