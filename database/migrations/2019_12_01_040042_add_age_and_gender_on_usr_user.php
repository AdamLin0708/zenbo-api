<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgeAndGenderOnUsrUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usr_user', function (Blueprint $table) {
            $table->string('gender', 80)->nullable();
            $table->integer('age')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('add_age_and_gender_on_usr_user');
    }
}
