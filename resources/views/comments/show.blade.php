<x-app-layout>
    <h1 class="title">
        {{ $comment->title }}
    </h1>
    <div class="content">
        <div class="content_post">
            <h3>本文</h3>
            <div class="edit"><a href="/posts/{{ $post->id }}/comments/ {{ $comment->id }}/edit">edit</a></div>
            <p>{{ $comment->body }}</p>    
        </div>
    </div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>