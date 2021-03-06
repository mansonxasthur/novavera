<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('developer_id');
            $table->unsignedInteger('location_id')->index();
            $table->string('name');
            $table->string('price')->nullable();
            $table->string('down_payment')->nullable();
            $table->string('installment_years')->nullable();
            $table->string('delivery_date')->nullable();
            $table->longText('description');
            $table->enum('project_type', ['residential', 'commercial', 'both']);
            $table->string('lat');
            $table->string('lng');
            $table->string('logo')->nullable();
            $table->string('slug');
            $table->text('meta')->nullable();
            $table->text('keywords')->nullable();
            $table->timestamps();

            $table->foreign('developer_id')->references('id')->on('developers')->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
