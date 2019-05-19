<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenshipSupplyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizenship_supply_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('citizenship_supply_id');
            $table->string('detail');

            $table->foreign('citizenship_supply_id')->references('id')->on('citizenship_supplies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizenship_supply_translations');
    }
}
