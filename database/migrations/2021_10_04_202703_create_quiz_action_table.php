<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_action', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quiz_id')->nullable(false);
            $table->bigInteger('user_id')->nullable(true);
            $table->json('data')->nullable(false);
            $table->boolean('finished')->default(false);
            $table->boolean('passed')->default(false);
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
        Schema::dropIfExists('quiz_action');
    }
}
