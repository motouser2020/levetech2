<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">編集画面</h1>
        
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class='mb-6'>
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">タイトル</h2>
                    <input type='text' name='post[title]' value="{{ $post->title }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class='mb-6'>
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">本文</h2>
                    <textarea name='post[body]' rows="6"
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $post->body }}</textarea>
                </div>
                
                <div class="flex justify-end">
                    <input type="submit" value="保存"
                           class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
