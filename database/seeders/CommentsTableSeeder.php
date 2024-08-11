<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 任意の数のコメントを生成
        for ($i = 0; $i < 10; $i++) {
            Comment::create([
                'user_id' => 1,
                'post_id' => 1,
                'title' => 'Sample Comment Title ' . $i,
                'body' => 'This is a sample comment body for comment number ' . $i,
            ]);
        }
    }
}
