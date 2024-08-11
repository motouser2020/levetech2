<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{

    // public function show(Post $post, Comment $comment)
    // {
    //     return view('comments.show')->with([
    //         'post' => $post,
    //         'comment' => $comment
    //     ]);
    // }
    
    public function create()
    {
        return view('comments.create');
    }
    
    public function store(Request $request, Post $post, Comment $comment)
    {
        $input = $request['comment'];
        $input['user_id'] = 1;
        $input['post_id'] = $post->id;
        $comment->fill($input)->save();
        return redirect('posts/' . $post->id . '/comments/' . $comment->id . '/edit');
    }
    
    public function edit(Post $post, Comment $comment)
    {
        return view('comments.edit')->with([
            'post' => $post,
            'comment' => $comment
        ]);
    }
    
    public function update(Request $request, Post $post, Comment $comment)
    {
        $input = $request['comment'];
        $input['user_id'] = 1;
        $comment->fill($input)->save();

        return redirect('posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
