<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인페이지</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="container mx-auto max-w-screen-lg">
    <div class="container w-full mx-auto py-8 my-16 flex flex-row flex-nowrap items-center">
        @if ($account['isLogin'] == true)
            <div class="w-1/2">
                <div class="inline-block align-middle border-2 rounded border-gray-400 size-40 mr-8"></div>
                <div class="inline-block align-middle">
                    <p><b>{{ $account['nickname'] }}</b>님 안녕하세요!</p>
                    <p>등급 : {{ $account['user_type'] }}</p>
                    <p>품종 : {{ $account['kind'] }}</p>
                    <p>나이 : {{ $account['age'] }}세</p>
                    <form action="/changeType" method="POST">
                        @csrf
                        <input type="hidden" name="target_email" id="target_email" value="{{ $account['email'] }}">
                        <button type="submit" class="text-slate-700 underline mt-4">
                            @if ($account['user_type'] == "멘티")
                                멘토로 변경
                            @else
                                멘티로 변경
                            @endif
                        </button>
                    </form>
                </div>
            </div>
            <div class="w-1/2">
                <a href="/logout" class="p-2 rounded bg-orange-400 font-bold block text-white my-4 text-center">로그아웃</a>
        @else
            <div class="w-1/2">
                <div class="inline-block align-middle border-2 rounded border-gray-400 size-40 mr-8"></div>
                <div class="inline-block align-middle">
                    <p><b>게스트</b>님 안녕하세요!</p>
                </div>
            </div>
            <div class="w-1/2">
                <a href="/mylogin" class="p-2 rounded bg-orange-400 font-bold block text-white my-4 text-center">로그인</a>

        @endif
                <a href="/boardWrite" class="p-2 rounded border-2 border-orange-400 font-bold block text-orange-400 text-center">질문 남기기(로그인 필요)</a>
            </div>
    </div>

    <div class="container">
        <h1 class="text-2xl text-orange-400 font-bold italic">&lt;고양이 질문&gt;</h1>
    </div>
    @if (!empty($board))
    <div class="container w-full mx-auto py-8 my-16">
        @foreach ($board as $item)
            <x-board_list :item="$item" button="show" ></x-board_list>
        @endforeach
        <div class="container w-full">
            <!-- 라라벨 자체에서 지원하는 paginator + Tailwind CSS 의 조합 -->
            {{ $paginate->links() }}
        </div>
    </div>
    @endif
    
</div>
</body>
</html>
