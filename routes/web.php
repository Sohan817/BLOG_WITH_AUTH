<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\blog\BlogController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

//User route
Route::prefix('user')->name("user.")->group(function () {
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.user.login')->name('login');
        Route::view('/register', 'dashboard.user.register')->name('register');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');
    });
    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {
        Route::get('dashboard/user/home', [BlogController::class, 'home_blog'])->name('home');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
});
//Blog Route
Route::get('/', [BlogController::class, 'guest'])->name('welcome');
Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('blogs/save', [BlogController::class, 'save'])->name('blogs.save');
Route::get('blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('blogs/{id}/update', [BlogController::class, 'update'])->name('blogs.update');
Route::get('blogs/{id}/show', [BlogController::class, 'show'])->name('blogs.show');
Route::get('blogs/myBlog', [BlogController::class, 'myBlog'])->name('blogs.myBlog');
Route::delete('blogs/{id}/delete', [BlogController::class, 'delete'])->name('blogs.delete');
