<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">コメント編集</h1>
        <form action="/posts/{{ $post->id }}/comments/{{ $comment->id }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">タイトル:</label>
                <input type="text" name="comment[title]" id="title" value="{{ $comment->title }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="body" class="block text-lg font-medium text-gray-700">本文:</label>
                <textarea name="comment[body]" id="body" rows="6"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $comment->body }}</textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">
                    更新
                </button>
            </div>
        </form>
        <div class="footer mt-10">
            <a href="{{ route('posts.show', $post->id) }}" class="block w-full text-center px-6 py-4 bg-gray-200 text-gray-800 font-semibold rounded-md hover:bg-gray-300 transition ease-in-out duration-150">
                戻る
            </a>
        </div>
    </div>
</x-app-layout>
