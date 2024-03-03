<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    protected $user_email;
    protected $user_kind;
    protected $user_type;

    protected $user_json;
    
    public function __construct(Auth $auth)
    {
        if($auth::check()){
            $data = json_decode($auth::user(),true);
            $this->user_email = $data["email"];
            $this->user_kind = $data["kind"];
            $this->user_type = $data["user_type"];
            $this->user_json = $data;
        }
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }

    public function userUpdate($update_array)
    {
        $result = User::where("email",$this->user_email)->update($update_array);
        if($result != 0){
            return true;
        } else {
            return false;
        }
    }

    public function bladeUserInfo()
    {
        $user_state = $this->user_json;
        if(empty($user_state)){
            $user_state["isLogin"] = false;
        } else {
            $user_state["isLogin"] = true;
        }
        return $user_state;
    }

    public function nowUserEmail()
    {
        return $this->user_email;
    }

    public function nowUserKind()
    {
        return $this->user_kind;
    }

    public function nowUserType()
    {
        return $this->user_type;
    }

    public function getOnlyUserInfo()
    {
        return $this->user_json;
    }
}
