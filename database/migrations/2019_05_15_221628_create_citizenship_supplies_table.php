<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenshipSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizenship_supplies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('citizenship_id');
            $table->string('detail');

            $table->foreign('citizenship_id')->references('id')->on('citizenships')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizenship_supplies');
    }
}
