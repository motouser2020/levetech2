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
            <!-- 評価項目の追加 -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">評価</h2>
                <div class="flex items-center" id="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <label class="flex items-center">
                            <input type="radio" name="post[stars]" value="{{ $i }}" class="hidden" {{ old('post.stars') == $i ? 'checked' : '' }}>
                            <svg class="w-8 h-8 cursor-pointer star text-gray-300" data-value="{{ $i }}" fill="currentColor" viewBox="0 0 24 24">
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
        <div class="mt-6 text-center">
            <a href="/posts" class="text-blue-500 hover:underline">戻る</a>
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
