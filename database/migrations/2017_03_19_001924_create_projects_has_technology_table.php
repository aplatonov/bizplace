<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsHasTechnologyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_has_technology', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('technology_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('projects_has_technology', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('technology_id')->references('id')->on('technology');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects_has_technology', function (Blueprint $table) {
            $table->dropForeign('projects_has_technology_user_id_foreign');
            $table->dropForeign('projects_has_technology_technology_id_foreign');
        });

        Schema::drop('projects_has_technology');
    }
}
