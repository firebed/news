<?php

use Firebed\News\Controllers\ContactController;
use Firebed\News\Controllers\HomepageController;
use Firebed\News\Controllers\User\ArticleController as UserArticleController;
use Firebed\News\Controllers\User\AuthorController;
use Firebed\News\Controllers\Widgets\PrayerTimeController;
use Firebed\News\Controllers\Widgets\WeatherForecastController;
use Illuminate\Support\Facades\Route;

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