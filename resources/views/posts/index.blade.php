<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-lg">
        <div class="text-right mb-6">
            <a href='/posts/create' class="inline-block px-6 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-md hover:bg-blue-600 transition duration-200">
                レビューを書く
            </a>
        </div>

        <div class='posts space-y-6'>
            @foreach ($posts as $post)
                <div class='post bg-gray-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300'>
                    <a href="/posts/{{ $post->id }}">
                        <h2 class='title text-2xl font-semibold text-gray-800 hover:text-blue-500 transition-colors duration-200'>
                            {{ $post->title }}
                        </h2>
                    </a>
                    <p class='body mt-4 text-gray-700'>
                        {{ \Illuminate\Support\Str::limit($post->body, 150, $end='...') }}
                    </p>
                    <p class='stars mt-2 text-yellow-500'>
                        {{ str_repeat('★', $post->stars) }}{{ str_repeat('☆', 5 - $post->stars) }}
                    </p>
                    
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-gray-500 flex items-center">
                            <i class="fas fa-heart text-red-500 mr-2"></i> {{ $post->likes_count }} いいね
                        </span>
                        <span class="text-gray-500 flex items-center">
                            <i class="fas fa-comment text-gray-500 mr-2"></i> {{ $post->comments_count }} コメント
                        </span>
                    </div>
                    
                    <div class="flex justify-end mt-4">
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePost({{ $post->id }})"
                                    class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-200">
                                削除
                            </button> 
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class='paginate mt-8'>
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        function deletePost(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>
