<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('person_name', 191)->unique();
            $table->text('description');
            $table->integer('speciality_id')->unsigned();
            $table->integer('experience')->nullable();
            $table->string('images', 90)->nullable();
            $table->string('resume', 90)->nullable();
            $table->integer('hour_rate')->nullable();
            $table->integer('user_id')->unsigned();
            $table->datetime('free_since')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });


        Schema::table('personal', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('speciality_id')->references('id')->on('speciality');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropForeign('personal_user_id_foreign');
            $table->dropForeign('personal_speciality_id_foreign');
        });

        Schema::drop('personal');
    }
}
