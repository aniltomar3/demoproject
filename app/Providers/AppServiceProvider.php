<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
use App\Observers\PostObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       // Paginator::useBootstrapFour();
       Gate::define('isAdmin',function(User $user){
         return $user->email==='demo@gmail.com';
       });

       Post::Observe(PostObserver::class);   // to run PostObserver
    }
}
