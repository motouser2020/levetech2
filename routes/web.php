<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('auth')->group(function () {
    
    // PostController
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');  // 一覧表示
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');  // 作成ページ
        Route::post('/', [PostController::class, 'store'])->name('posts.store');  // 新規作成
        Route::get('/{post}', [PostController::class ,'show'])->name('posts.show');  // 詳細表示
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');  // 編集ページ
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');  // 更新
        Route::delete('/{post}', [PostController::class,'delete'])->name('posts.delete');  // 削除
    });
    
    // CostController
    Route::prefix('posts/{post}/comments')->group(function () {
        // Route::get('/', [CommentController::class, 'index'])->name('comments.index'); // コメント一覧
        Route::post('/', [CommentController::class, 'store'])->name('comments.store'); // コメント作成
        Route::get('/{comment}', [CommentController::class, 'show'])->name('comments.show'); // コメント詳細
        Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit'); // コメント詳細
        Route::put('/{comment}', [CommentController::class, 'update'])->name('comments.update'); // コメント更新
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy'); // コメント削除
    });
    
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
