<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Http\Controllers\BoardConfigController;
use App\Http\Controllers\AccountController;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerConfigController extends Controller
{
    public function saveToAnswer($parent_uuid, $reply_content)
    {
        $ac = new AccountController(new Auth);
        $user_kind = $ac->nowUserKind();

        Answer::create([
            "parent_uuid" => $parent_uuid,
            "content" => $reply_content,
            "kind" => $user_kind,
        ]);
    }

    public function checkAnswerMaxCount($parent_uuid)
    {
        $answer = Answer::where("parent_uuid",$parent_uuid)->get();
        if(count($answer) >= 3){
            return false;
        } else {
            return true;
        }
    }

    public function checkChooseInAnswer(int $id)
    {
        $answer = Answer::where("id",$id)->first();
        $parent_uuid = $answer->parent_uuid;

        $other_asw = Answer::where("parent_uuid",$parent_uuid)->get();
        $flag = true;
        foreach ($other_asw as $json) {
            if($json->choose != 0){
                $flag = false;
            }
        }
        return $flag;
    }

}
