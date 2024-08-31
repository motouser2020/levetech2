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
                
                <!-- 評価項目の追加 -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">評価</h2>
                    <div class="flex items-center" id="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="flex items-center">
                                <input type="radio" name="post[stars]" value="{{ $i }}" class="hidden" {{ $post->stars == $i ? 'checked' : '' }}>
                                <svg class="w-8 h-8 cursor-pointer star {{ $post->stars >= $i ? 'text-yellow-500' : 'text-gray-300' }}" data-value="{{ $i }}" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 .587l3.668 7.431L23.1 9.748l-5.775 5.623L18.905 24 12 19.763 5.095 24l1.58-8.629L.9 9.748l7.432-1.73L12 .587z" />
                                </svg>
                            </label>
                        @endfor
                    </div>
                    <p class="text-red-600 mt-2">{{ $errors->first('post.stars') }}</p>
                </div>

                <div class="flex justify-end">
                    <input type="submit" value="保存"
                           class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 cursor-pointer">
                </div>
            </form>
        </div>
        
        <div class="footer mt-10">
            <a href="{{ route('posts.show', $post->id) }}" class="block w-full text-center px-6 py-4 bg-gray-200 text-gray-800 font-semibold rounded-md hover:bg-gray-300 transition ease-in-out duration-150">
                戻る
            </a>
        </div>
    </div>

    <!-- JavaScript for star rating -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star');

            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const value = this.getAttribute('data-value');
                    document.querySelectorAll('.star').forEach((s, index) => {
                        if (index < value) {
                            s.classList.add('text-yellow-500');
                            s.classList.remove('text-gray-300');
                        } else {
                            s.classList.add('text-gray-300');
                            s.classList.remove('text-yellow-500');
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
