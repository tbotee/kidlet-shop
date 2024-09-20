<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
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
        View::composer('*', function ($view) {
            $categories = Category::orderBy('order', 'asc')->get();
            $userService = $this->app->make(UserService::class);
            $user = $userService->getAuthenticatedUser();
            $view->with('categories', $categories);
            $view->with('cartItemCount', $user->shoppingCart?->items?->count() ?? 0) ;
        });
    }
}
