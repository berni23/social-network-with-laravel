<?php

use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\commentController;

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
Route::middleware(['auth:sanctum', 'verified'])->get('/posts/new', [postController::class, 'new'])->name('newPost');
Route::middleware(['auth:sanctum', 'verified'])->post('/posts/create', [postController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->get('/posts/edit/{id}', [postController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/posts/update/{id}', [postController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/posts/delete/{id}', [postController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'verified'])->post('/comments/create', [commentController::class, 'store'])->name('newComment');
