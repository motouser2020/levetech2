<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = 
    [
        'title',
        'body',
        'user_id',
        'post_id',
    ];
    
    // 投稿とのリレーションを定義
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    // ユーザーとのリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPaginateByLimit(int $limit_count = 5)
    {
         return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
