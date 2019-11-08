<?php
/**
 * Created by PhpStorm.
 * User: ucarer
 * Date: 2018/6/20
 * Time: 下午5:34
 */

namespace App\Repository;


use App\Entity\gvr\CaregiverProfile;
use App\Entity\loc\Phone;
use App\Entity\pt\PatientProfile;
use App\Entity\usr\User;
use App\Entity\pt\Patient;
use App\Entity\pt\EmergencyContact;
use App\Entity\gvr\Caregiver;
use App\Entity\vlt\Volunteer;
use App\Repository\Capp\CaregiverRepo;
use App\Repository\Ucarer\BlockchainRepo;
use App\Repository\Ucarer\Contract;
use App\Utility\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\JWTAuth;

class VideoRepo
{
    public static function getVideoLists(){

        $video = DB::table('vd_video_zv')->get();

        return successResponse(null, $video);
    }

    public static function getVideoDetail($video_id, $user){


        $output = array();

        $video = DB::table('vd_video_zv')
            ->where('video_id', $video_id)
            ->first();

        //測驗題
        $quiz_user_lists = DB::table('vd_quiz_user_zv')
            ->where('video_id', $video_id)
            ->where('user_id', $user->user_id)
            ->get();

        $video->quiz_user_lists = $quiz_user_lists;

        $output['video'] = $video;

        return successResponse(null, $output);
    }

    public static function getQuizLists($video_id){
        $output = array();

        $quizLists = DB::table('vd_quiz')
            ->select('quiz_id', 'description')
            ->where('video_id', $video_id)
            ->get();

        foreach ($quizLists as $quizList){
            $answers = DB::table('vd_quiz_answer')
                ->select('quiz_answer_id', 'description')
                ->where('quiz_id', $quizList->quiz_id)
                ->get();

            $quizList->answers = $answers;
        }

        Log::info($quizLists);


        $output['quizLists'] = $quizLists;

        return successResponse(null, $output);
    }

    public static function submitVideoQuiz($request, $user){

        $video_id = $request['video_id'];
        $answers = $request['answers'];

        foreach ($answers as $key => $answer){
            $split = explode('_', $key);
            $quiz_id = $split[1];
            $quiz_answer_id = $answer;


            DB::table('vd_quiz_user')->insert([
                'user_id' => $user->user_id,
                'quiz_id' => $quiz_id,
                'quiz_answer_id' => $quiz_answer_id,
                'created_by' => $user->user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_by' => $user->user_id,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        }

        $output = array();

        $video = DB::table('vd_video_zv')
            ->where('video_id', $video_id)
            ->first();

        //測驗題
        $quiz_user_lists = DB::table('vd_quiz_user_zv')
            ->where('video_id', $video_id)
            ->where('user_id', $user->user_id)
            ->get();

        $video->quiz_user_lists = $quiz_user_lists;

        $output['video'] = $video;

        return successResponse(null, $output);
    }

}