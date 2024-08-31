<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg relative">
        <!-- 編集ボタン -->
        <div class="absolute top-4 right-4">
            <a href="/posts/{{ $post->id }}/edit" class="text-gray-500 hover:text-gray-700 transition ease-in-out duration-150">
                <i class="fas fa-edit fa-lg">編集</i>
            </a>
        </div>

        <!-- 投稿の表示 -->
        <div class="mb-8 border-b border-gray-300 pb-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>

            <!-- 評価の表示 -->
            <div class="flex items-center mb-4">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-8 h-8 {{ $post->stars >= $i ? 'text-yellow-500' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 .587l3.668 7.431L23.1 9.748l-5.775 5.623L18.905 24 12 19.763 5.095 24l1.58-8.629L.9 9.748l7.432-1.73L12 .587z" />
                    </svg>
                @endfor
            </div>

            <!-- 本文 -->
            <p class="text-gray-700 leading-relaxed mb-4">{{ $post->body }}</p>

            <div class="mb-4 flex items-center justify-between">
                <!-- いいねボタンといいね解除ボタン -->
                @if (Auth::user()->likedPosts()->where('post_id', $post->id)->exists())
                    <form action="/unlike/{{ $post->id }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center text-red-500 hover:text-red-700 transition ease-in-out duration-150">
                            <i class="fas fa-heart mr-2"></i>いいね解除
                        </button>
                    </form>
                @else
                    <form action="/like/{{ $post->id }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-500 hover:text-red-500 transition ease-in-out duration-150">
                            <i class="far fa-heart mr-2"></i>いいね
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- コメントの表示 -->
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
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">コメントを投稿</button>
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
                                <div class="edit-comment text-right space-x-2">
                                    <!-- 編集ボタン -->
                                    <a href="/posts/{{ $post->id }}/comments/{{ $comment->id }}/edit" 
                                       class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition ease-in-out duration-150">
                                        編集
                                    </a>
                                    <!-- 削除ボタン -->
                                    <form action="/posts/{{ $post->id }}/comments/{{ $comment->id }}" id="comment_form_{{ $comment->id }}" method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleteComment({{ $comment->id }})" 
                                                class="inline-block px-4 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition ease-in-out duration-150">
                                            削除
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>

        <div class="footer mt-10">
            <a href="/posts" class="block w-full text-center px-6 py-4 bg-gray-200 text-gray-800 font-semibold rounded-md hover:bg-gray-300 transition ease-in-out duration-150">
                戻る
            </a>
        </div>


    </div>
    <script>
        function deleteComment(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`comment_form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>
