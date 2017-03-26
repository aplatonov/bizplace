<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalHasTechnologyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_has_technology', function (Blueprint $table) {
            $table->integer('person_id')->unsigned();
            $table->integer('technology_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('personal_has_technology', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('personal');
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
        Schema::table('personal_has_technology', function (Blueprint $table) {
            $table->dropForeign('personal_has_technology_person_id_foreign');
            $table->dropForeign('personal_has_technology_technology_id_foreign');
        });

        Schema::drop('personal_has_technology');
    }
}
