<?php

use App\Http\Controllers\InformationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
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
Auth::routes();
Route::apiResource('information',InformationController::class);
Route::get('/books', function () {
    return view('books.IndexBooks');
});
Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');

Route::Resource('book',BookController::class);
Route::Resource('category',CategoryController::class);
Route::middleware(['IsAdmin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::apiResource('user', UserController::class);
});
