<?php

namespace App\Http\Controllers;

use App\Entity\usr\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repository\AuthRepo;
use Illuminate\Support\Facades\Auth;
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

        if(empty($credential['password']) || empty($credential['email']) || empty($credential['age']) || empty($credential['gender'])){
            return "";
        }

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

        if (Auth::attempt(['email_login' => $loginCredential['email_login'], 'password' => $loginCredential['password']]))
        {
            $user = Auth::user();

            Log::info($user);

            if(empty($user)){
                Log::info('here');
                return "";
            }

            if($user->user_type_code_abbr == 'ZAPP'){

                Log::info('here123');

                Log::info($user->device_token);
                $token = JWTAuth::fromUser($user);

                Log::info($token);

                DB::table('usr_user')->where('user_id', $user->user_id)->update([
                    'device_token' => $token,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $user->user_id
                ]);

                Log::info($user->device_token);

                $data = array();
                $data['user_id'] = $user->user_id;
                $data['token'] = $token;

                return $token;
            } else {

                return "";
            }

        }

        return "";




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
