<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenshipBenefitTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizenship_benefit_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('citizenship_benefit_id');
            $table->string('detail');

            $table->foreign('citizenship_benefit_id')->references('id')->on('citizenship_benefits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizenship_benefit_translations');
    }
}
