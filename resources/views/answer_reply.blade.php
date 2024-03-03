<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>댓글 달기</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<div class="w-full">
    <div class="container mx-auto max-w-screen-lg my-16">
        <h1 class="text-5xl font-bold my-16 text-red-300">질문에 대한 답변 남기기 </h1>
        @if (count($posted) != 0)
            <x-board_list :item="$posted" button="hidden"></x-board_list>
        @endif
        <div class="container">
            @if ($user_type == "멘토")
                @if (count($posted['answers']) >= 3)
                    <p class="p-8 bg-gray-300 text-gray-600 text-sm w-full rounded">* 질문당 최대 3개까지 답변을 등록할 수 있습니다.</p>
                @else
                    <form action="/reply" method="POST" class="w-full">
                        @csrf
                        <input type="hidden" name="parent_uuid" id="parent_uuid" value="{{ $posted['id'] }}">
                        <div>
                            <label for="reply_content" class="text-2xl font-bold my-8 text-black block">답변하기</label>
                            <textarea name="reply_content" id="reply_content" cols="40" rows="20"
                                class="rounded border-2 border-orange-300 h-32 w-full mb-8"></textarea>
                        </div>
                        <button type="submit" class="w-full py-4 text-base text-white block bg-orange-300 rounded">댓글 작성</button>
                    </form>
                @endif
            @else
                <p class="p-8 bg-gray-300 text-gray-600 text-sm w-full rounded">* 멘토만이 답변을 남기실 수 있습니다.</p>
            @endif
        </div>
    </div>
</div>
</body>
</html>
