<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }

    public function show(Post $post, Comment $comment)
    {
        return view('posts.show')->with([
            'post' => $post,
            'comments' => $comment->get()
        ]);
    }
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $input['user_id'] = 1;
        $input['stars'] = 4;
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();

        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }
    
    public function favorite(Request $request, Article $article)
    {
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) 
        {
            // Userのid取得
            $user_id = Auth::id();

            // 既にいいねしているかチェック
            $existingFavorite = Like::where('post_id', $post->id)
                ->where('user_id', $user_id)
                ->first();

            // 既にいいねしている場合は何もせず、そうでない場合は新しいいいねを作成する
            if (!$existingFavorite) 
            {
                $like = new Like();
                $like->article_id = $post->id;
                $like->user_id = $user_id;
                $like->save();
            }

            // 記事の状態を返す
            return response()->json([
                'post' => 
                [
                    'slug' => $post->slug,
                    'title' => $post->title,
                    'description' => $post->description,
                    'body' => $post->body,
                    'tagList' => $post->tags->pluck('name'),
                    'createdAt' => $post->created_at,
                    'updatedAt' => $post->updated_at,
                    'liked' => true, // いいねされた状態を示す
                    'likesCount' => $post->likes()->count(), // いいねの合計数を取得
                ]
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }
}
