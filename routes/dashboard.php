<?php

use Firebed\News\Controllers\Dashboard\ArticleController;
use Firebed\News\Livewire\Admin\Article\CreateArticle;
use Firebed\News\Livewire\Admin\Article\EditArticle;
use Firebed\News\Livewire\Admin\Article\ShowArticles;
use Firebed\News\Livewire\Admin\User\CreateUser;
use Firebed\News\Livewire\Admin\User\EditUser;
use Firebed\News\Livewire\Admin\User\ShowUsers;
use Firebed\News\Models\Article;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'active'])->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::view('dashboard', 'admin.dashboard.index')->name('dashboard');

//        Route::resource('articles', ArticleController::class);

        Route::get('articles', ShowArticles::class)->name('articles.index');
        Route::get('articles/{article}/edit', EditArticle::class)->name('articles.edit');
        Route::get('articles/create', CreateArticle::class)->name('articles.create');

        Route::get('users/create', CreateUser::class)->name('users.create');
        Route::get('users/{user}/edit', EditUser::class)->name('users.edit');
        Route::get('users', ShowUsers::class)->name('users.index');

        Route::get('articles/{article}/photos', function (Article $article) {
            return view('admin.articles.partials.article-image-picker', ['images' => $article->photos]);
        });
    });
});