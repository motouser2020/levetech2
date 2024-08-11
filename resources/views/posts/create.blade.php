<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Blog Name</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('post.title') }}">
                <p class="text-red-600 mt-2">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">レビュー内容</h2>
                <textarea name="post[body]" placeholder="素晴らしいサービスでした"
                          class="w-full h-40 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('post.body') }}</textarea>
                <p class="text-red-600 mt-2">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="flex justify-end">
                <input type="submit" value="保存"
                       class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 cursor-pointer">
            </div>
        </form>
        <div class="mt-6 text-center">
            <a href="/" class="text-blue-500 hover:underline">戻る</a>
        </div>
    </div>
</x-app-layout>
