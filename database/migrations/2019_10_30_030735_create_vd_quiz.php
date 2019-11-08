<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVdQuiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vd_quiz', function (Blueprint $table) {
            $table->integer('quiz_id', true, false);
            $table->integer('video_id');
            $table->string('description', 80);
            $table->integer('correct_quiz_answer_id')->nullable();

            $table->integer('created_by')->nullable();
            $table->datetime('created_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->integer('program_created_by')->nullable();
            $table->datetime('program_created_at')->nullable();
            $table->integer('program_updated_by')->nullable();
            $table->datetime('program_updated_at')->nullable();

            $table->foreign('video_id')->references('video_id')->on('vd_video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vd_quiz');
    }
}
