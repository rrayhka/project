<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', Controllers\HomeController::class)->name('home');
Route::get('/about', [Controllers\AboutController::class, 'index'])->name('about');
Route::get('/contact', [Controllers\ContactController::class, 'index'])->name('contact');

Route::resource('users', Controllers\UserController::class)->middleware('auth');
// Route::get('/users', [Controllers\UserController::class, 'index'])->name('users.index');
// Route::get('/users/create', [Controllers\UserController::class, 'create'])->name('users.create');
// Route::post('/users', [Controllers\UserController::class, 'store'])->name('users.store');
// Route::get('/users/{user:id}', [Controllers\UserController::class, 'show'])->name('users.show');
// Route::get('/users/{user:id}/edit', [Controllers\UserController::class, 'edit'])->name('users.edit');
// Route::put('/users/{user:id}', [Controllers\UserController::class, 'update'])->name('users.update');
// Route::delete('/users/{user:id}', [Controllers\UserController::class, 'destroy'])->name('users.destroy');


Route::get('login', [Controllers\LoginController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('login', [Controllers\LoginController::class, 'authenticate']);
Route::post('logout', Controllers\LogoutController::class, 'logout')->name('logout')->middleware('auth');