<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 任意の数のユーザーを生成
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'establishment_at' => now()->subYears(rand(1, 20))->format('Y-m-d'), // 1から20年前のランダムな日付
                'employees' => rand(10, 500), // 10から500のランダムな従業員数
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // ハッシュ化されたパスワード
                'remember_token' => \Str::random(10),
            ]);
        }
    }
}
