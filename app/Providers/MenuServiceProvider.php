<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\MenuService;
class MenuServiceProvider extends ServiceProvider
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
    // public function boot()
    // {
    //     View::composer('*', function ($view) {
    //         $menuService = new MenuService();
    //         $menu = $menuService->getMenuByRole();
    //         $view->with('formattedMenu', $menu);
    //     });
    // }
}
