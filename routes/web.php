<?php

use Firebed\News\Controllers\ContactController;
use Firebed\News\Controllers\HomepageController;
use Firebed\News\Controllers\User\ArticleController as UserArticleController;
use Firebed\News\Controllers\User\AuthorController;
use Firebed\News\Controllers\Widgets\PrayerTimeController;
use Firebed\News\Controllers\Widgets\WeatherForecastController;
use Firebed\News\Livewire\Admin\Article\CreateArticle;
use Firebed\News\Livewire\Admin\Article\EditArticle;
use Firebed\News\Livewire\Admin\Article\ShowArticles;
use Firebed\News\Livewire\Admin\User\CreateUser;
use Firebed\News\Livewire\Admin\User\EditUser;
use Firebed\News\Livewire\Admin\User\ShowUsers;
use Firebed\News\Models\Article;
use Firebed\News\Services\SlugGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active'])->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::view('dashboard', 'admin.dashboard.index')->name('dashboard');

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

    Route::prefix('api')->group(function () {
        Route::get('slugify', fn(Request $request) => SlugGenerator::getSlug($request->input('text')));
    });
});

Route::get('weather-forecast', WeatherForecastController::class)->name('weather-forecast');
Route::get('prayer-times', PrayerTimeController::class)->name('prayer-times');

Route::group(['as' => 'user.'], function () {
    Route::get('/', HomepageController::class)->name('homepage');

    Route::resource('authors', AuthorController::class)->only('index', 'show')->parameter('authors', 'author:slug');

    Route::resource('contact', ContactController::class)->only('index', 'store');
    Route::get('tag/{tag:slug}', [UserArticleController::class, 'search_by_tag'])->name('articles.search_by_tag');
    Route::get('search', [UserArticleController::class, 'search'])->name('articles.search');
    Route::get('tum-haberler', [UserArticleController::class, 'all_news'])->name('articles.all_news');
    Route::get('{type:slug}', [UserArticleController::class, 'index'])->name('articles.index');
    Route::get('{type:slug}/{article:slug}', [UserArticleController::class, 'show'])->name('articles.show');
});