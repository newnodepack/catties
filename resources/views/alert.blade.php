<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인페이지</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<div class="w-full">
    <div class="container mx-auto max-w-screen-md my-16 bg-gray-100 rounded-lg p-8">
        <div class="bg-red-400 rounded-full size-24 text-center mx-auto flex justify-center items-center">
            <p class="text-white text-4xl font-bold ">!</p>
        </div>
        <h4 class="text-black text-xl text-center my-8">{{ $msg }}</h4>
        @if ($action == "goHome")
            <a href="/" class="bg-red-400 py-4 text-base text-white text-center w-full">메인으로 돌아가기</a>
        @else
            <button id="return_to_back" class="bg-red-400 py-4 text-base text-white text-center w-full">이전페이지로 돌아가기</button>
        @endif
    </div>
</div>
<script>
    const back_btn = document.getElementById(`return_to_back`);
    back_btn.addEventListener(`click`,()=>{
        window.history.back();
    });
</script>
</body>
</html>
