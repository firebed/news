<?php

namespace Firebed\News;

use App\View\Components\SimilarNews;
use Firebed\News\Commands\InstallCommand;
use Firebed\News\Commands\SitemapCommand;
use Firebed\News\Livewire\Admin\Article\CreateArticle;
use Firebed\News\Livewire\Admin\Article\EditArticle;
use Firebed\News\Livewire\Admin\Article\ShowArticles;
use Firebed\News\Livewire\Admin\Navigation;
use Firebed\News\Livewire\Admin\User\CreateUser;
use Firebed\News\Livewire\Admin\User\EditUser;
use Firebed\News\Livewire\Admin\User\ShowUsers;
use Firebed\News\Middleware\Active;
use Firebed\News\Models\Article;
use Firebed\News\Models\User;
use Firebed\News\View\Components\LatestColumns;
use Firebed\News\View\Components\LatestNews;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class NewsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerConfig();
        $this->registerTranslations();
        $this->registerMigrations();
        $this->registerMorphs();
        $this->registerViews();
        $this->registerRoutes();
        $this->registerCommands();
        $this->registerPublishing();

        app('router')->aliasMiddleware('active', Active::class);

        Livewire::component('dashboard-navigation', Navigation::class);
        Livewire::component('show-articles', ShowArticles::class);
        Livewire::component('create-article', CreateArticle::class);
        Livewire::component('edit-article', EditArticle::class);
        Livewire::component('show-users', ShowUsers::class);
        Livewire::component('edit-user', EditUser::class);
        Livewire::component('create-user', CreateUser::class);
    }

    private function registerConfig(): void
    {

    }

    private function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'news');
    }

    private function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    private function registerMorphs(): void
    {
        Relation::morphMap([
            'user'    => User::class,
            'article' => Article::class
        ]);
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'news');

        $this->loadViewComponentsAs('news', [
            LatestColumns::class,
            LatestNews::class,
            SimilarNews::class,
        ]);
    }

    private function registerRoutes(): void
    {
        Route::mixin(new UserRoutes);
        $this->loadRoutesFrom(__DIR__ . '/../routes/dashboard.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    private function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                SitemapCommand::class,
            ]);
        }
    }
    private function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../resources/lang' => resource_path('lang/vendor/user')], 'news-locale');
            $this->publishes([__DIR__ . '/../resources/lang/tr.json' => resource_path('lang/tr.json')], 'news-locale-tr');

            $this->publishes([__DIR__ . '/../resources/views/user' => resource_path('views/vendor/news/user')], 'news-user-views');
            $this->publishes([__DIR__ . '/../resources/views/dashboard' => resource_path('views/vendor/user/dashboard')], 'news-dashboard-views');
        }
    }
}