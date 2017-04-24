<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampsFeedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feed_categories', function (Blueprint $table) {
            $default = date('Y m d H:i:s');
            $table->timestamp('created_at')->default($default);
            $table->timestamp('updated_at')->default($default);
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
            $table->dropTimestamps();
        });
    }
}
