<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Answer;

class BoardConfigController extends Controller
{
    protected $board_data;
    protected $page_board;

    public function __construct()
    {
        $this->board_data = Board::all();
        $this->page_board = Board::paginate(6);
    }

    public function getBoardListwithAnswer()
    {        
        $encode = json_encode($this->page_board);

        $board_with_pg = json_decode($encode,true);

        $unite = [];
        foreach ($board_with_pg['data'] as $array) {
            $sort_answer = [];
            $all_answer = Answer::where("parent_uuid",$array['id'])->get();
            foreach ($all_answer as $json) {
                $answer_arr = json_decode($json,true);
                array_push($sort_answer,$answer_arr);
            }
            $array['answers'] = $sort_answer;
            array_push($unite,$array);
        }

        return $unite;
    }

    public function returnAnswerPG()
    {
        return $this->page_board;
    }

    public function oneBoardwithAnswer(string $page_uid)
    {
        $data = [];
        foreach ($this->board_data as $obj) {
            if($obj->id == $page_uid){
                $array = json_decode($obj,true);
                $data = $array;
                $all_answer = Answer::where("parent_uuid",$page_uid)->get();
                $sort_answer = [];
                foreach ($all_answer as $json) {
                    $answer_arr = json_decode($json,true);
                    array_push($sort_answer,$answer_arr);
                }
                $data["answers"] = $sort_answer;
            }
        }
        return $data;
    }
}
