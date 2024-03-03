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
<div class="w-full">
    <div class="container mx-auto max-w-screen-lg my-16">
        <h2 class="text-6xl font-bold">질문하기</h2>
        <form action="/boardWrite" method="POST" class="my-8 w-full">
            @csrf
            <div class="my-4">
                <label for="question_title" class="text-xl font-bold block mb-2">제목</label>
                <input type="text" name="question_title" id="question_title" class="w-full h-12 bg-white border-2 border-orange-400 rounded">
            </div>
            <div class="my-4">
                <label for="question_category" class="text-xl font-bold block mb-2">카테고리</label>
                <select name="question_category" id="question_category" class="w-full h-12 bg-white border-2 border-orange-400 rounded">
                    <option value="집사고민">집사고민</option>
                    <option value="사료고민">사료고민</option>
                    <option value="그루밍">그루밍</option>
                </select>
            </div>
            <div class="my-4">
                <label for="question_content" class="text-xl font-bold block mb-2">내용</label>
                <textarea name="question_content" id="question_content" cols="30" rows="10"
                class="w-full h-32 bg-white border-2 border-orange-400 rounded"></textarea>
            </div>
            <div class="mt-8">
                <button type="submit" class="bg-orange-400 rounded py-4 text-base text-white w-full">질문남기기</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
