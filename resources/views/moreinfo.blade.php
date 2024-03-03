<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>추가 정보를 입력해 주세요.</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<div class="w-full">
    <div class="container mx-auto">
        <div class="container my-16">
            <h1 class="text-5xl text-black font-bold mb-4">추가 정보를 입력해야 합니다.</h1>
            <p class="inline-block text-gray-500 mr-2 text-sm">사용자 이름 :</p>
            <p class="inline-block text-gray-500 font-bold text-sm">{{ $nickname }}</p>
        </div>
        <form action="/register" method="POST" class="w-full my-8">
            @csrf
            <div class="container">
                <div class="my-4">
                    <label for="cat_kind" class="block text-lg text-gray-600">품종</label>
                    <input type="text" name="cat_kind" id="cat_kind" class="w-full h-12 border-2 rounded">
                </div>
                <div class="my-4">
                    <label for="cat_age" class="block text-lg text-gray-600">나이</label>
                    <select name="cat_age" id="cat_age" class="w-full h-12 border-2 rounded">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="bg-orange-400 rounded w-full py-4 font-bold text-center text-white mt-8">회원가입</button>
        </form>
    </div>

</div>
</body>
</html>