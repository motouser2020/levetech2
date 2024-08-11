<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 任意の数の投稿を生成
        for ($i = 0; $i < 10; $i++) {
            Post::create([
                'user_id' => 1,
                'title' => 'Sample Post Title ' . $i,
                'body' => 'This is a sample post body for post number ' . $i,
                'stars' => rand(1, 5), // 1から5のランダムな星の数を設定
            ]);
        }
    }
}
