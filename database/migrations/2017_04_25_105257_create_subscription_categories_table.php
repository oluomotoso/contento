<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');//
            $table->integer('subscription_id')->unsigned();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');//
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
        Schema::table('subscription_categories', function (Blueprint $table) {
            $table->dropForeign('subscription_categories_category_id_foreign');
            $table->dropForeign('subscription_categories_subscription_id_foreign');

        });
        Schema::dropIfExists('subscription_categories');
    }
}
