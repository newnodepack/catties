<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 페이지</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<div class="w-full">
    <form class="container mx-auto max-w-screen-md p-8 my-8 bg-gray-100 rounded-lg" method="POST" action="">
        <h1 class="text-6xl text-center text-orange-300 mb-12">Login</h1>
        <label for="login_id" class="block text-sm text-gray-500 mt-8 mb-2">아이디</label>
        <input type="text" class="block w-full h-12 rounded border-2 border-orange-200" id="login_id" name="login_id">
        <label for="login_pw" class="block text-sm text-gray-500 mt-8 mb-2">비밀번호</label>
        <input type="text" class="block w-full h-12 rounded border-2 border-orange-200" id="login_pw" name="login_pw">
        <button class="my-8 bg-orange-200 text-center text-base py-4 rounded w-full text-orange-600" disabled="disabled">로그인</button>

        <div class="container my-8 flex flex-row items-center">
            <div class="border-b-2 border-gray-300 w-1/3"></div>
            <div class="w-1/3 text-center text-sm text-gray-300">
                또는
            </div>
            <div class="border-b-2 border-gray-300 w-1/3"></div>
        </div>
        <a href="https://kauth.kakao.com/oauth/authorize?response_type=code&client_id=7fa4a48f652e5623d74800eaa4a457c0&redirect_uri=http://127.0.0.1/social"
         class="block size-24 mx-auto">
            <img src="../../images/KakaoTalk_logo.png" alt="" class="">
        </a>
    </form>
</div>
</body>
</html>
