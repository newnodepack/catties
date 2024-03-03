<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BoardConfigController;
use App\Http\Controllers\AnswerConfigController;
use App\Http\Controllers\AccountController;
use App\Models\Answer;

class AnswerRouteController extends Controller
{
    public function directTo(string $parent_uid, AccountController $accbind)
    {
        $bcc = new BoardConfigController;
        $board = $bcc->oneBoardwithAnswer($parent_uid);

        return view("answer_reply",["posted" => $board, "user_type" => $accbind->nowUserType()]);
    }

    public function saveAnswer(Request $request)
    {
        $token = csrf_token();

        $valid = $request->validate([
            "parent_uuid" => "required",
            "reply_content" => "required|min:1"
        ]);

        $acc = new AnswerConfigController;
        $max_count = $acc->checkAnswerMaxCount($request->parent_uuid);

        if(!$max_count){
            $message = [
                "msg" => "답변할 수 있는 최대 개수를 초과했습니다.",
                "action" => "goHome"
            ];
            return view("alert", $message);
        }

        $acc->saveToAnswer($request->parent_uuid, $request->reply_content);
        return redirect("/");
    }

    public function chooseAnswer(int $id, AccountController $accbind)
    {
        if($accbind->nowUserType() != "멘티"){
            $message = [
                "msg" => "멘티 만이 해당 질문을 채택할 수 있습니다.",
                "action" => "back"
            ];
            return view("alert", $message);
        }

        $acc = new AnswerConfigController;
        $flag = $acc->checkChooseInAnswer($id);

        if(!$flag){
            $message = [
                "msg" => "해당 질문에 이미 채택이 되어 있는 답변이 있습니다.",
                "action" => "back"
            ];
            return view("alert", $message);
        }

        Answer::where("id",$id)->update(["choose" => 1]);
        return back();
    }

    public function deleteAnswer(int $id)
    {
        $asw = Answer::where("id",$id)->first();

        if($asw->choose == 0){
            $result = Answer::where("id",$id)->delete();
            return back();
        } else if (empty($asw)){
            return redirect("/");
        } else {
            $message = [
                "msg" => "채택되어 있는 답변은 삭제할 수 없습니다.",
                "action" => "back"
            ];
            return view("alert", $message);
        }

    }
}
