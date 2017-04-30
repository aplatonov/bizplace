<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPersonalTableAddSkill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal', function(Blueprint $table) {
            $table->integer('skill_id')->unsigned()->nullable()->default(null);
        });

        Schema::table('personal', function (Blueprint $table) {
            $table->foreign('skill_id')->references('id')->on('skills');
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
            $table->dropForeign('personal_skill_id_foreign');
        });

        Schema::table('personal', function(Blueprint $table) {
            $table->dropColumn('skill_id');
        });
    }
}
