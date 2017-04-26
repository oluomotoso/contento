<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishingParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishing_parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('identifier_id')->unsigned();
            $table->text('parameters')->nullable();
            $table->integer('subscription_domain_id')->unsigned();
            $table->foreign('subscription_domain_id')->references('id')->on('subscription_domains');
            $table->boolean('to_draft')->default(false);
            $table->boolean('publish_all')->default(false);
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
        Schema::table('publishing_parameters', function (Blueprint $table) {
            $table->dropForeign('publishing_parameters_subscription_domain_id_foreign');
        });
        Schema::dropIfExists('publishing_parameters');
    }
}
