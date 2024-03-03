<div class="container w-full mb-24">
    <h3 class="text-black text-2xl font-bold">{{ $item['title'] }}</h3>
    <div class="mt-2 my-4">
        <p class="inline text-sm text-white mt-2 bg-red-400 rounded mr-2 py-1 px-2">{{ $item['category'] }}</p>
        <p class="inline text-sm text-white bg-orange-400 rounded mr-2 py-1 px-2">{{ $item['kind'] }}</p>
    </div>
    <div class="p-4 border-2 border-red-400 bg-white rounded">
        <p class="text-base">{{ $item['content'] }}</p>
    </div>
    @if ($button == "show")
        <a href="/reply/{{ $item['id'] }}" class="inline-block mt-4 bg-red-400 rounded py-2 px-4 font-bold text-lg text-white">해당 질문에 답변하기</a>
    @endif
    <div class="pl-8 py-8">
        @foreach ($item['answers'] as $reply)
            <div class="mb-8">
                <h5 class="text-xl italic text-black font-bold">댓글</h5>
                <div class="my-2 flex flex-row justify-between items-center">
                    <p class="text-sm text-white mt-2 bg-orange-400 rounded mr-2 py-1 px-2">{{ $reply['kind'] }}</p>
                    <p class="text-sm text-gray-300 text-right">작성일자: {{ $reply['created_at'] }}</p>
                </div>
                <p class="p-4 border-2 border-orange-400 rounded bg-white">{{ $reply['content'] }}</p>
                <div class="container text-right my-2">
                    <a class="inline-block bg-gray-600 text-white p-2 ml-4 text-sm rounded" href="/answerChoose/{{ $reply['id'] }}">답변 채택하기</a>
                    <a class="inline-block underline text-gray-600 p-2 ml-4 text-sm" href="/answerDelete/{{ $reply['id'] }}">삭제</a>
                </div>
                @if ($reply['choose'] != 0)
                    <p class="text-sm mt-2 text-green-300 text-right">&#x2713; 채택됨</p>
                @endif 
            </div>
        @endforeach
    </div>
    <div class="border-b-2 border-solid border-gray-100 mt-12"><!-- 절취선 --> </div>
</div>