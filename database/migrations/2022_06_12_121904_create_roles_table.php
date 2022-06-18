<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('users_permissions')->default('0000');
            $table->string('roles_permissions')->default('0000');
            $table->string('topics_permissions')->default('0000');
            $table->string('tags_permissions')->default('0000');
            $table->string('questions_permissions')->default('0000');
            $table->string('quizzes_permissions')->default('0000');
            $table->string('study_books_permissions')->default('0000');
            $table->string('study_materials_permissions')->default('0000');
            $table->string('study_videos_permissions')->default('0000');
            $table->string('study_sites_permissions')->default('0000');
            $table->string('vacancies_permissions')->default('0000');
            $table->string('sent_questions_permissions')->default('0000');
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
        Schema::dropIfExists('roles');
    }
}
