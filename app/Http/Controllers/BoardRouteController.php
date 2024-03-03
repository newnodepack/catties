<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class BoardRouteController extends Controller
{
    public function directTo()
    {
        return view("board_write");
    }

    public function writeContent(Request $request, AccountController $acbind)
    {
        $token = csrf_token();

        $valid = $request->validate([
            "question_title" => "required",
            "question_category" => "required",
            "question_content" => "required"
        ]);

        $user_info = $acbind->getOnlyUserInfo();

        $result = Board::create([
            "title" => $request->question_title,
            "content" => $request->question_content,
            "category" => $request->question_category,
            "kind" => $user_info["kind"],
        ]);

        return redirect("/");
    }
}
