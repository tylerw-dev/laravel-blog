<?php

use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('post');

Route::get('categories/{category:slug}', function (Category $category) {
  return view('posts', [
    'posts'           => $category->posts->load('category', 'author'),
    'currentCategory' => $category,
    'categories'      => Category::all()
  ]);
})->name('category');

Route::get('authors/{author:username}', function (User $author) {
  return view('posts', [
    'posts'      => $author->posts->load('category', 'author'),
    'categories' => Category::all()
  ]);
})->name('author');
