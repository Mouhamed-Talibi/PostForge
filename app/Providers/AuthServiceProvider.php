<?php

namespace App\Providers;

use App\Models\Creator;
use App\Models\Post;
use App\Policies\AdminPolicy;
use App\Policies\CreatorPolicy;
use App\Policies\PostPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // protected policites
    protected $policies = [
        Post::class => PostPolicy::class,
        Creator::class => CreatorPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //  
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->register();
    }
}
