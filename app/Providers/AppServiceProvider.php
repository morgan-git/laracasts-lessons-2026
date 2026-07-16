<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\FeedProvider;
use App\Models\User;
use App\Services\RedditService;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[\Override]
    public function register(): void
    {
        $providers = [
            'reddit' => RedditService::class,
            // 'youtube' => YouTubeService::class,
        ];

        foreach ($providers as $name => $class) {
            $this->app->bind(FeedProvider::class.':'.$name, $class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-admin', fn (User $user) => $user->isAdmin() ? Response::allow() : Response::denyAsNotFound());

        Model::unguard();
        Model::shouldBeStrict();
        Model::automaticallyEagerLoadRelationships();
    }
}
