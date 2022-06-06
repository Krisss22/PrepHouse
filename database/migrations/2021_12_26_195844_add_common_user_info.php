<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommonUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->nullable(true);
            $table->string('education')->nullable(true);
            $table->text('certificates')->nullable(true);
            $table->text('address')->nullable(true);
            $table->boolean('news')->default(false);
            $table->boolean('surveys')->default(false);
            $table->boolean('promotions')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('education');
            $table->dropColumn('certificates');
            $table->dropColumn('address');
            $table->dropColumn('news');
            $table->dropColumn('surveys');
            $table->dropColumn('promotions');
        });
    }
}
