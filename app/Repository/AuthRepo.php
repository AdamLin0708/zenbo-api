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

class AuthRepo
{
    public static function register($basicInfo){

        $email = $basicInfo['email'];
        $password = $basicInfo['password'];

        $start_time = microtime(true);
        DB::beginTransaction();

        //先建立user
        $user = new User();
        $user->email_login = $email;
        $user->password_encrypted = Hash::make($password);
        $user->user_type_code_abbr = 'ZAPP';

        // update device related info on usr_user table
        $user->platform = isset($basicInfo['platform']) ? $basicInfo['platform']: null;
        $user->device_token = isset($basicInfo['device_token']) ? $basicInfo['device_token']: '1';
        $user->save();
        $user->whocol($user->user_id, date('Y-m-d H:i:s'), $user->user_id, date('Y-m-d H:i:s'));
        $user->save();

        $end_time = microtime(true);
        $spent_time = $end_time - $start_time;
        Log::info('建立會員資料 '. $spent_time . 'secs');

        DB::commit();

        $data = array();
        $data['user'] = $user;

        return successResponse(null, $data);
    }

    public static function updateToken($user, $token){

        $oldUser = User::where('user_id', $user->user_id);
        $oldUser->device_token = $token;
        $user->whocol(null, null, $user->user_id, date('Y-m-d H:i:s'));
        $user->save();

        return;
    }

    public static function login($basicInfo){

    }


}