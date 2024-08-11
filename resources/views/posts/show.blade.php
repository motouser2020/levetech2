<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">
            {{ $post->title }}
        </h1>
        
        <div class="content mb-8">
            <div class="content_post mb-6">
                <h3 class="text-2xl font-semibold text-gray-700 mb-4">本文</h3>
                <div class="edit mb-4">
                    <a href="/posts/{{ $post->id }}/edit" class="text-blue-500 hover:underline">編集</a>
                </div>
                <p class="text-gray-700 leading-relaxed">{{ $post->body }}</p>
            </div>
        </div>

        <div class="comments mb-8">
            <h3 class="text-2xl font-semibold text-gray-700 mb-6">コメント</h3>

            <div class="create-comment mb-8">
                <h4 class="text-xl font-semibold text-gray-700 mb-4">コメントを追加</h4>
                <form action="/posts/{{ $post->id }}/comments" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="title" class="block text-gray-700 font-medium">タイトル:</label>
                        <input type="text" name="comment[title]" id="title" value="{{ old('comment.title') }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="body" class="block text-gray-700 font-medium">本文:</label>
                        <textarea name="comment[body]" id="body" rows="4" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('comment.body') }}</textarea>
                    </div>
                    <div>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">コメントを投稿</button>
                    </div>
                </form>
            </div>

            <div class="comments space-y-6">
                @if($post->comments->isEmpty())
                    <p class="text-gray-700">まだコメントはありません。</p>
                @else
                    @foreach ($post->comments as $comment)
                        <div class="comment bg-gray-100 p-6 rounded-lg shadow-md flex items-start">
                            <img src="{{ $comment->user->profile_image_url ?? 'https://media.istockphoto.com/id/1221957491/ja/%E3%82%B9%E3%83%88%E3%83%83%E3%82%AF%E3%83%95%E3%82%A9%E3%83%88/%E3%83%AC%E3%83%83%E3%82%B5%E3%83%BC%E3%83%91%E3%83%B3%E3%83%80%E3%83%9D%E3%83%BC%E3%83%88%E3%83%AC%E3%83%BC%E3%83%88.jpg?s=1024x1024&w=is&k=20&c=EX_SCKiF4quJw-3JA7Mrd-aJEKVbuE9PcaFaYWmpHGc=' }}" 
                                 alt="{{ $comment->user->name }}" 
                                 class="w-10 h-10 rounded-full mr-4">
                            <div class="flex-1">
                                <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ $comment->title }}</h4>
                                <p class="text-gray-700 mb-4">{{ $comment->body }}</p>
                                <p class="text-sm text-gray-500 mb-2">投稿者: {{ $comment->user->name }}</p>
                                <p class="text-sm text-gray-500 mb-4">投稿日: {{ $comment->created_at }}</p>
                                <div class="edit-comment text-right">
                                    <a href="/posts/{{ $post->id }}/comments/{{ $comment->id }}/edit" 
                                       class="text-blue-500 hover:underline">編集</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="footer text-center mt-10">
            <a href="/posts" class="text-blue-500 hover:underline">戻る</a>
        </div>
    </div>
</x-app-layout>
