<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicasaphotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picasaphotos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('picasa_id');
            $table->text('original_url');
            $table->text('picasa_link');
            $table->integer('api_data_id')->unsigned();
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
        Schema::dropIfExists('picasaphotos');
    }
}
