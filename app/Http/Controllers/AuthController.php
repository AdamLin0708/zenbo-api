<?php

namespace App\Http\Controllers;

use App\Entity\usr\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repository\AuthRepo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function checkIsValidAccount(){
        $credential = Request::all();

        $count = DB::table('usr_user')->where('email_login', $credential['email'])->count();

        if($count > 0 ){
            return errorResponse(null, null);
        }

        return successResponse(null, null);
    }

    public function register(){

        $credential = Request::all();

        $output = AuthRepo::register($credential);

        if($output['status'] == 'success'){
            $output['data']['token'] = self::genUserToken($output['data']['user']);
            AuthRepo::updateToken($output['data']['user'], $output['data']['token']);
        }

        return $output['data']['token'];
    }

    public function login(){

        $credential = Request::all();

        $loginCredential = array();
        $loginCredential['email_login'] = $credential['email'];
        $loginCredential['password'] = $credential['password'];

        $token = JWTAuth::attempt($loginCredential);

        \Illuminate\Support\Facades\Auth::once($loginCredential);

        $user = \Illuminate\Support\Facades\Auth::user();

        if(empty($user)){
            return "";
        }

        $data = array();
        $data['user_id'] = $user->user_id;
        $data['token'] = $token;

        return $token;
    }


    public function logout(){


        $user = JWTAuth::parseToken()->toUser();

        $userEntity = User::where('user_id', $user->user_id)->first();
        $userEntity->device_token = null;
        $userEntity->platform = null;
        $userEntity->whocol(null, null, $user->user_id, date('Y-m-d H:i:s'));
        $userEntity->save();

        return successResponse(null);

    }

    public function test(){

        $headers = Request::header();

        Log::info($headers);

        $data = array();
        $data['test'] = '123';

        return successResponse(null, $data);
    }

    private function genUserToken($user){
        $token = JWTAuth::fromUser($user);
        return $token;
    }

}
