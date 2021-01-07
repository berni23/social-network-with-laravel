<?php

use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\likeController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/home', [userController::class, 'home'])->name('home');
Route::middleware(['auth:sanctum', 'verified'])->get('/profile', [userController::class, 'show'])->name('profile');
Route::middleware(['auth:sanctum', 'verified'])->get('/posts/{group}/{offset}/{limit}', [userController::class, 'paginatePosts']);
Route::middleware(['auth:sanctum', 'verified'])->get('/posts/new', [postController::class, 'new'])->name('newPost');
Route::middleware(['auth:sanctum', 'verified'])->get('/posts/edit/{id}', [postController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/posts/create', [postController::class, 'store']);

// user.confirm.post -> middleware for checking that indeed, the user trying to update/delete is the post owner

// user.confirm.comment -> middleware for checking that indeed, the post being commented belongs to a friend or the user

Route::middleware(['auth:sanctum', 'verified', 'user.confirm.post'])->post('/posts/update/{id}', [postController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified', 'user.confirm.post'])->post('/posts/delete/{id}', [postController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'verified', 'user.confirm.comment'])->post('/comments/create', [commentController::class, 'store'])->name('newComment');
Route::middleware(['auth:sanctum', 'verified'])->get('/likes/{likeable}/{id}', [likeController::class, 'toggleLike']);
