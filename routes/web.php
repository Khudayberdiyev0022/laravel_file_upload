<?php

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

Route::view('/', 'index')->name('index');

Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
Route::post('categories/create', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{category}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}/update', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
Route::get('posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::put('posts/{post}/update', [\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::post('posts/create', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::delete('posts/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
