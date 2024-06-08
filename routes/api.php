<?php

use App\Http\Controllers\api\ActionLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// auth:sanctum is token based apis
// sanctum middleware ကာလိုက်ပြီဆိုရင် api token နဲ့ ဝင်မှ အဆင်ပြေတယ်
Route::post('user/login', [AuthController::class, 'login']);
Route::post('user/register', [AuthController::class, 'register']);
Route::get('user/profile', [AuthController::class, 'profile']);

// category
Route::get('categories', [CategoryController::class, 'categoryList']);
Route::post('search/category', [CategoryController::class, 'searchCategory']);

// post
Route::get('posts', [PostController::class, 'postList']);
Route::post('search/post', [PostController::class, 'searchPost']);
Route::post('post/details/', [PostController::class, 'postDetails']);

// action log
Route::post('post/viewCount', [ActionLogController::class, 'viewCount']);

// comment
Route::post('comments', [CommentController::class, 'getComments']);
Route::post('comment/create', [CommentController::class, 'createComment']);

