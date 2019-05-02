<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderImageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_image_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('slider_image_id');
            $table->string('locale');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('btn_label')->nullable();

            $table->foreign('slider_image_id')->references('id')->on('slider_images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_image_translations');
    }
}
