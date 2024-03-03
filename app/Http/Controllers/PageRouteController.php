<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BoardConfigController;

class PageRouteController extends Controller
{
    public function mainPage(AccountController $acc)
    {
        $user_data = $acc->bladeUserInfo();
        $bcc = new BoardConfigController;
        $board_list = $bcc->getBoardListwithAnswer();
        $pagination = $bcc->returnAnswerPG();

        return view('main_page',["account" => $user_data, "board" => $board_list, "paginate" => $pagination]);
    }

    public function loginPage()
    {
        return view("sign_up");
    }
}
