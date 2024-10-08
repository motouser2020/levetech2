<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = 
    [
        'title',
        'body',
        'user_id',
        'stars',
    ];

    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    // コメントとのリレーションを定義
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function users() 
    {
        return $this->belongsTo(User::class);
    }

    public function likedByUsers()     
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
    
    // いいねの数を取得するアクセサ
    public function getLikesCountAttribute()
    {
        return $this->likedByUsers()->count();
    }
    
    // コメントの数を取得するアクセサ
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }
}
