<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstantController extends Controller
{
    public function showDialog(string $msg, string $action)
    {
        $message = [
            "msg" => $msg,
            "action" => $action
        ];
        return view("alert", $message);
    }
}
