<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebSetup\SidebarNav;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $navItems = SidebarNav::whereNull('parent_id')
                ->where('status', 'A')
                ->with('children')
                ->orderBy('order')
                ->get();

            $view->with('navItems', $navItems);
        });
    }


    // public function boot()
    // {
    //     View::composer('*', function ($view) {
    //         $user = Auth::user();
        
    //         // Step 1: Get the roles assigned to the user
    //         $userRoleNames = $user->getRoleNames()->toArray(); // Get role names (e.g. ['Admin', 'HR'])
        
    //         // Step 2: Get the permissions associated with those roles
    //         $permissions = [];
    //         foreach ($userRoleNames as $roleName) {
    //             $role = Role::findByName($roleName);
    //             $permissions = array_merge($permissions, $role->permissions->pluck('name')->toArray()); // Merge all permissions for the roles
    //         }
        
    //         // Step 3: Filter permissions that contain "view" (for view-based access)
    //         $viewPermissions = array_filter($permissions, function($permission) {
    //             return str_contains($permission, 'view');
    //         });
        
    //         // Step 4: Fetch sidebar menu items based on filtered permissions
    //         $navItems = SidebarNav::whereNull('parent_id')
    //             ->where('status', 'A') // Only active items
    //             ->where(function ($query) use ($viewPermissions) {
    //                 foreach ($viewPermissions as $permission) {
    //                     $query->orWhere('name', 'LIKE', "%$permission%"); // Match sidebar item name with permission (e.g., view_dashboard)
    //                 }
    //             })
    //             ->with(['children' => function ($query) use ($viewPermissions) {
    //                 foreach ($viewPermissions as $permission) {
    //                     $query->orWhere('name', 'LIKE', "%$permission%"); // Match child sidebar item name with permission
    //                 }
    //             }])
    //             ->orderBy('order')
    //             ->get();
        
    //         // Pass the filtered nav items to the view
    //         $view->with('navItems', $navItems);
    //     });
    // }
}
