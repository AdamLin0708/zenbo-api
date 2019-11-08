<?php

namespace App\Http\Controllers;

use App\Repository\VideoRepo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class VideoController extends Controller
{
    public function getVideoLists(){

        $output = VideoRepo::getVideoLists();

        return $output;

    }

    public function getVideoDetail(){

        $user = JWTAuth::parseToken()->toUser();

        $video_id = Request::all();

        $output = VideoRepo::getVideoDetail($video_id, $user);

        return $output;
    }

    public function getQuizLists(){
        $video_id = Request::all();

        $output = VideoRepo::getQuizLists($video_id);

        return $output;
    }

    public function submitVideoQuiz(){

        $user = JWTAuth::parseToken()->toUser();

        $request = Request::all();

        $output = VideoRepo::submitVideoQuiz($request, $user);

        return $output;
    }
}
