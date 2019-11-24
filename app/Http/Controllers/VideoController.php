<?php

namespace App\Http\Controllers;

use App\Entity\usr\User;
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

        $request = Request::all();

        $token = $request['token'];

        $user = User::where('device_token', $token)->first();

        $output = VideoRepo::getVideoDetail($request, $user);

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
