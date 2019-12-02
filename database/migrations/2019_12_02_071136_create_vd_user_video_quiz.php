<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVdUserVideoQuiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vd_user_video_quiz', function (Blueprint $table) {
            $table->integer('user_video_quiz_id', true, false);
            $table->integer('user_id')->nullable();
            $table->string('video_specific_id', 80)->nullable();
            $table->integer('quiz_id')->nullable();
            $table->integer('answer_id')->nullable();
            $table->boolean('correct_flag')->nullable();

            $table->integer('created_by')->nullable();
            $table->datetime('created_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->integer('program_created_by')->nullable();
            $table->datetime('program_created_at')->nullable();
            $table->integer('program_updated_by')->nullable();
            $table->datetime('program_updated_at')->nullable();

            $table->foreign('user_id')->references('user_id')->on('usr_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vd_user_video_quiz');
    }
}
