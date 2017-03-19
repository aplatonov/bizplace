<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHasTechnologyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_has_technology', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('technology_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('users_has_technology', function (Blueprint $table) {
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
        Schema::table('users_has_technology', function (Blueprint $table) {
            $table->dropForeign('users_has_technology_user_id_foreign');
            $table->dropForeign('users_has_technology_technology_id_foreign');
        });

        Schema::drop('users_has_technology');
    }
}
