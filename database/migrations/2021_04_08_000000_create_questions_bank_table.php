<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_bank', function (Blueprint $table) {
            $table->id();
            $table->integer('job_vacancy')->nullable();
            $table->string('question');
            $table->integer('addedByAdmin')->default(0);
            $table->integer('release')->default(0);
            $table->string('answer')->nullable();
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
        Schema::dropIfExists('questions_bank');
    }
}
