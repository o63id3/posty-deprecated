<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UploadController;

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

// Route::get('/', function () {
//     return view('home');
// });

// Auth routes
Route::get('/register', [AuthController::class, 'registerShow']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginShow'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Post routes
Route::get('/', [PostController::class, 'index']);
Route::get('/post/{post}', [PostController::class, 'show']);
Route::post('/post', [PostController::class, 'store']);
Route::delete('/post/{post}', [PostController::class, 'destroy']);
Route::put('/post/{post}', [PostController::class, 'update']);

// Like a post routes
Route::post('/post/{post}/like', [LikeController::class, 'store'])->name(
    'post.like'
);
Route::delete('/post/{post}/like', [LikeController::class, 'destroy'])->name(
    'post.unlike'
);

// Comment on post routes
Route::post('/post/{post}/comment', [CommentController::class, 'store'])->name(
    'post.comment'
);

// Users routes
Route::get('/user/{user:username}', [UserController::class, 'show']);
Route::get('/settings', [UserController::class, 'edit']);
Route::put('/settings/{user:username}', [UserController::class, 'update']);
Route::get('/password', [UserController::class, 'editPassword']);
Route::put('/password/{user:username}', [
    UserController::class,
    'updatePassword',
]);

// Search route
Route::get('/search/', [SearchController::class, 'search'])->name('search');

// test image upload
Route::post('/upload', [UploadController::class, 'store']);
