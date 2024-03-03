<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BoardRouteController;
use App\Http\Controllers\AnswerRouteController;
use App\Http\Controllers\AnswerConfigController;
use App\Http\Controllers\PageRouteController;
use App\Http\Middleware\CheckLogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 홈페이지 테스트 전, 마이그레이션을 먼저 진행해 주세요!

// 메인 페이지와 로그인 페이지 라우트
Route::get('/', [PageRouteController::class,'mainPage']);
Route::get('/mylogin',[PageRouteController::class,'loginPage']);

// 가입시 추가정보를 입력하는 페이지와 정보를 변경하는 페이지로 라우트
Route::get('/social',[SignUpController::class,'kakaoLogin']);
Route::get('/register',[SignUpController::class,'enterInfo']);
Route::post('/register',[SignUpController::class,'store']);
Route::post('/changeType',[SignUpController::class,'changeUserType']);


// 로그아웃 기능을 가진 함수를 호출
Route::get('/logout',[AccountController::class,'logout']);

// 질문은 등록하는 페이지 및 등록하기 기능이 있는 곳으로 라우트
Route::get('/boardWrite',[BoardRouteController::class,'directTo'])->middleware(CheckLogin::class); // 로그인이 필요한 페이지의 경우 미들웨어로 여부를 체크합니다.
Route::post('/boardWrite',[BoardRouteController::class,'writeContent']);

// 답변하는 페이지 및 데이터를 저장하는 곳으로 라우트
Route::get('/reply/{parent_uid}',[AnswerRouteController::class,'directTo'])->middleware(CheckLogin::class);
Route::post('/reply',[AnswerRouteController::class,'saveAnswer']);
Route::get('/answerChoose/{id}',[AnswerRouteController::class,'chooseAnswer']);
Route::get('/answerDelete/{id}',[AnswerRouteController::class,'deleteAnswer']);