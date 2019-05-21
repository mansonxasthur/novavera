<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizenships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_name');
            $table->string('slug');
            $table->enum('type', ['citizenship', 'residency', 'both']);
            $table->string('dropdown_flag');
            $table->string('body_flag');
            $table->string('header');
            $table->string('title');
            $table->longText('description');
            $table->text('snippet');
            $table->text('meta')->nullable();
            $table->text('keywords')->nullable();
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
        Schema::dropIfExists('citizenships');
    }
}
