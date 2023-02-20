<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FavorController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ListImageController;
use App\Http\Controllers\ReplyCommentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShowAuthorController;
use App\Http\Controllers\ShowImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ListImageController::class)->name('images.all');
Route::get('/images/{image}', ShowImageController::class)->name('images.show');
Route::post('/images/{image}/comment', [CommentController::class, 'store'])->name('comments.store');
Route::post('/images/{image}/likes', LikeController::class)->name('likes.update');

Route::post('/images/{image}/favorites', [FavorController::class, 'update'])->name('favorites.update');
Route::get('/account/favorites', [FavorController::class, 'index'])->name('favorites.index');
Route::get('/downloads/images/{image}', DownloadController::class)->name('downloads');

Route::get('/tags/{tag:slug}', ListImageController::class)->name('images.tag');
Route::get('/@{user:username}', ShowAuthorController::class)->name('author.show');

Route::resource('/account/images', ImageController::class)->except('show');
Route::get('/account/settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('/account/settings', [SettingController::class, 'update'])->name('settings.update');
Route::get('/account/comments', [CommentController::class, 'index'])->name('comments.index');
Route::put('/account/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/account/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/account/comments/{comment}/reply', [ReplyCommentController::class, 'create'])->name('comments.reply.create');
Route::post('/account/comments/{comment}/reply', [ReplyCommentController::class, 'store'])->name('comments.reply.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/images', [ImageController::class, 'index'])->name('images.index');
// Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');
// Route::post('/images', [ImageController::class, 'store'])->name('images.store');

// Route::get('/images/{image}/edit', [ImageController::class, 'edit'])
//         ->name('images.edit');
//         // ->can('update', 'image');
//         // ->middleware('can:update, image');
// Route::put('/images/{image}', [ImageController::class, 'update'])->name('images.update');
// Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

// Route::view('/test-blade', 'test');
