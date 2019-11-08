<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVdQuizUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vd_quiz_user', function (Blueprint $table) {
            $table->integer('quiz_user_id', true, false);
            $table->integer('user_id');
            $table->integer('quiz_id');
            $table->integer('quiz_answer_id');

            $table->integer('created_by')->nullable();
            $table->datetime('created_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->integer('program_created_by')->nullable();
            $table->datetime('program_created_at')->nullable();
            $table->integer('program_updated_by')->nullable();
            $table->datetime('program_updated_at')->nullable();

            $table->foreign('user_id')->references('user_id')->on('usr_user');
            $table->foreign('quiz_id')->references('quiz_id')->on('vd_quiz');
            $table->foreign('quiz_answer_id')->references('quiz_answer_id')->on('vd_quiz_answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vd_quiz_user');
    }
}
