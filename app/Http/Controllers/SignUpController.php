<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AccountController;

class SignUpController extends Controller
{
    public function enterInfo(AccountController $acbind)
    {
        $userinfo = $acbind->getOnlyUserInfo();
        
        if(count($userinfo) != 0){
            return view("moreinfo",["nickname" => $userinfo['nickname'], "email" => $userinfo['email']]);
        } else {
            return redirect("/");
        }
        
    }

    public function store(Request $request,AccountController $acbind)
    {
        $token = $request->session()->token();
        $token = csrf_token();

        $validate = $request->validate([
            "cat_kind" => "required",
            "cat_age" => "required|max:15"
        ]);

        $update_array = [
            "kind" => $request->cat_kind,
            "age" => $request->cat_age
        ];

        $acbind->userUpdate($update_array);

        return redirect("/");
        
    }

    public function kakaoLogin(Request $request,AccountController $acbind)
    {
        // 인가 토큰 받기
        $auth_code = $request->input("code");
        $token_url = 'https://kauth.kakao.com/oauth/token';

        $REST_API_KEY = "7fa4a48f652e5623d74800eaa4a457c0";
        $REDIRECT_URI = "http://127.0.0.1/social";
        $CLIENT_SECRETES = "hkZt6EHFRvHjiiO662f2irHqYRD0Ae96";

        $token_info = array(
            'grant_type' => 'authorization_code',
            'client_id' => $REST_API_KEY, 
            'redirect_uri' => $REDIRECT_URI,
            'code' => $auth_code,
            'client_secret' => $CLIENT_SECRETES
        );

        $ch = curl_init($token_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_info));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/x-www-form-urlencoded"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        // json 토큰을 분해
        $json_response = json_decode($response, true);

        if (isset($json_response["access_token"])) {
            $info_url = "https://kapi.kakao.com/v2/user/me";
            $accessToken = $json_response["access_token"];

            $ch = curl_init($info_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $accessToken
            ));
            $token_response = curl_exec($ch);
            curl_close($ch);

            $token_to_json = json_decode($token_response, true);
            $nickname = $token_to_json["kakao_account"]["profile"]["nickname"];
            $email = $token_to_json["kakao_account"]["email"];
            $password = $token_to_json["id"];

            if(!$nickname || !$email || !$password){
                return "회원가입에 필요한 정보가 없습니다.";
            }

            $check_account = User::where("email",$email)->first();

            $cred = [
                "nickname" => $nickname,
                "email" => $email,
                "password" => $password
            ];

            if(empty($check_account)){
                User::create($cred);
                $check_account = User::where("email",$email)->first();
            }

            if(Auth::attempt($cred)){
                $request->session()->regenerate();
            }

            if($check_account->kind == null){
                return redirect("/register");
            }
            
            return redirect("/");
        } else {
            return '카카오로그인에 실패하였습니다.';
        }
        
    }

    public function changeUserType(Request $request, AccountController $acbind)
    {
        $token = csrf_token(); 
        $valid = $request->validate([
            "target_email" => "required|email"
        ]);

        $account_info = User::where("email",$request->target_email)->first();
        $before = $account_info->user_type;

        if($before == "멘티"){
            $acbind->userUpdate(["user_type" => "멘토"]);
        } else {
            $acbind->userUpdate(["user_type" => "멘티"]);
        }
        
        return redirect("/");
    }
}
