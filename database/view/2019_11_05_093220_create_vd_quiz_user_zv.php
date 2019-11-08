<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVdQuizUserZv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public static $table_name = 'vd_quiz_user_zv';
    public function up()
    {
        //DB::statement('DROP VIEW IF EXISTS '. self::$table_name);
        $view_name = self::$table_name;
        $sql = <<<EOF
create or replace view $view_name as
select
	vd_quiz_user.quiz_user_id,
	vd_quiz_user.user_id,	
	vd_quiz_user.quiz_id,
	vd_quiz.video_id,
	vd_quiz.description as quiz_description,
	vd_quiz.correct_quiz_answer_id,
	tb_correct_quiz_answer.description as correct_quiz_answer_description,
	vd_quiz_user.quiz_answer_id,
	vd_quiz_answer.description as quiz_answer_description
from vd_quiz_user
left join vd_quiz on vd_quiz_user.quiz_id = vd_quiz.quiz_id
left join vd_quiz_answer as tb_correct_quiz_answer on tb_correct_quiz_answer.quiz_answer_id = vd_quiz.correct_quiz_answer_id
left join vd_quiz_answer on vd_quiz_user.quiz_answer_id = vd_quiz_answer.quiz_answer_id
EOF;

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
