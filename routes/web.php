<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;

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


Route::middleware('user_auth')->group(function () {
    Route::get('/', [AuthController::class, 'loginPage']);
    Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    // Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');


});

Route::middleware([
    'auth', config('jetstream.auth_session'), 'verified',
])->group(function () {

    Route::middleware(["user_auth"])->group(function () {
        Route::prefix('admin/')->group(function () {
            // direct admin dashboard
            Route::get('dashboard', [ProfileController::class, 'index'])->name('admin#dashboard');

            // profile
            Route::get('profile', [ProfileController::class, 'index'])->name('admin#profile');
            Route::post('account/update', [ProfileController::class, 'adminUpdateAccount'])->name('admin#updateAccount');

            // direct change password page
            Route::get('change/password', [ProfileController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('admin#changePassword');

            // category
            Route::get('category', [CategoryController::class, 'index'])->name('admin#category');
            Route::get('category/search', [CategoryController::class, 'searchCategory'])->name('admin#searchCategory');
            Route::post('create/category', [CategoryController::class, 'createCategory'])->name('admin#createCategory');
            Route::get('edit/category/{id}', [CategoryController::class, 'editCategory'])->name('admin#editCategory');
            Route::post('update/category/{id}', [CategoryController::class, 'updateCategory'])->name('admin#updateCategory');
            Route::delete('delete/category/{id}', [CategoryController::class, 'deleteCategory'])->name('admin#deleteCategory');

            // Admin List
            Route::get('list', [ListController::class, 'index'])->name('admin#list');
            Route::post('deleteAccount/{id}', [ListController::class, 'deleteAccount'])->name('admin#deleteAccount');
            Route::post('list/search', [ListController::class, 'adminListSearch'])->name('admin#listSearch');

            // post
            Route::get('posts', [PostController::class, 'index'])->name('admin#post');
            Route::post('create/post', [PostController::class, 'create'])->name('admin#createPost');
            Route::get('edit/post/{id}', [PostController::class, 'edit'])->name('admin#editPost');
            Route::post('update/post/{id}', [PostController::class, 'updatePost'])->name('admin#updatePost');
            Route::delete('delete/post/{id}', [PostController::class, 'deletePost'])->name('admin#deletePost');

            // trend post
            Route::get('trend-posts', [TrendPostController::class, 'index'])->name('admin#trend-post');
            Route::get('trend-posts/details/{id}', [TrendPostController::class, 'details'])->name('admin#trend-posts-details');
        });
    });
});
