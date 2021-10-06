<?php

namespace App\Providers;

use App\Repository\{
    CommentRepository,
    CommentRepositoryInterface,
    CommunityRepository,
    CommunityRepositoryInterface,
    PostRepository,
    PostRepositoryInterface,
};
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class,
        );
        $this->app->bind(
            CommunityRepositoryInterface::class,
            CommunityRepository::class,
        );
        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
