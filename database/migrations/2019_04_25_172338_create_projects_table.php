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
            $table->longText('description');
            $table->enum('project_type', ['residential', 'commercial', 'both']);
            $table->string('lat');
            $table->string('lng');
            $table->string('logo')->nullable();
            $table->string('slug');
            $table->text('meta')->nullable();
            $table->text('keywords')->nullable();

            $table->foreign('developer_id')->references('id')->on('developers')->onCascade('delete');
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
        Schema::dropIfExists('projects');
    }
}
