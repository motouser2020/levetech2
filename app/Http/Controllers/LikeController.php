<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    
    // いいねする処理
    public function like(Post $post)
    {
        $user = Auth::user();

        if (!$user->likedPosts()->where('post_id', $post->id)->exists()) {
            $user->likedPosts()->attach($post->id);
            return redirect('/posts/' . $post->id);
        }

        return redirect('/posts/' . $post->id);
    }
    
    // いいねを解除する処理
    public function unlike(Post $post)
    {
        $user = Auth::user();

        if ($user->likedPosts()->where('post_id', $post->id)->exists()) {
            $user->likedPosts()->detach($post->id);
            return redirect('/posts/' . $post->id);
        }

         return redirect('/posts/' . $post->id);
    }
}
