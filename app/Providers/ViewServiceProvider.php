<?php

namespace App\Providers;

use App\Models\setup\MenuModel;
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
    // public function boot()
    // {
    //     View::composer('*', function ($view) {
    //         $navItems = SidebarNav::whereNull('parent_id')
    //             ->where('status', 'A')
    //             ->with('children')
    //             ->orderBy('order')
    //             ->get();

    //         $view->with('navItems', $navItems);
    //     });
    // }

    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
    
            if (!$user) {
                $view->with('formattedMenu', []);
                return;
            }
    
            $roleId = $user->roles->first()->id ?? null;
    
            if (!$roleId) {
                $view->with('formattedMenu', []);
                return;
            }
    
            $menus = MenuModel::whereIn('id', function ($query) use ($roleId) {
                $query->select('menu')
                    ->from('menu_assign')
                    ->where('role_id', $roleId);
            })
            ->orderByRaw("CASE WHEN parent_id IS NULL OR parent_id = '#' THEN 0 ELSE 1 END")
            ->orderBy('id', 'asc')
            ->get();
    
            // Prepare arrays
            $menuMap = [];
            $formattedMenu = [];
    
            // Step 1: Build the menu map
            foreach ($menus as $menu) {
                // Normalize `parent_id`, treating `"#"` as `NULL`
                $parentId = ($menu->parent_id === '#' || $menu->parent_id === null) ? null : $menu->parent_id;
    
                $menuMap[$menu->id] = [
                    'id' => $menu->id,
                    'parent_id' => $parentId,
                    'title' => $menu->title,
                    'desc' => $menu->desc,
                    'url' => $menu->url,
                    'icon' => $menu->icon,
                    'submenu' => [],
                ];
            }
    
            // Step 2: Assign submenus correctly
            foreach ($menuMap as $id => &$menu) {
                if ($menu['parent_id'] !== null && isset($menuMap[$menu['parent_id']])) {
                    $menuMap[$menu['parent_id']]['submenu'][] = &$menu;
                } else {
                    $formattedMenu[] = &$menu; // Include all top-level menus
                }
            }
    
            // Share the formatted menu across all views
            $view->with('formattedMenu', $formattedMenu);
        });
    }
    

    // public function boot()
    // {
    //     // Share menu data with all views
    //     View::composer('*', function ($view) {
    //         $user = Auth::user();

    //         if (!$user) {
    //             $view->with('formattedMenu', []);
    //             return;
    //         }

    //         $roleId = $user->roles->first()->id ?? null;

    //         if (!$roleId) {
    //             $view->with('formattedMenu', []);
    //             return;
    //         }

    //         $menus = MenuModel::whereIn('id', function ($query) use ($roleId) {
    //             $query->select('menu')
    //                 ->from('menu_assign')
    //                 ->where('role_id', $roleId);
    //         })
    //             ->orderByRaw("CASE WHEN parent_id IS NULL OR parent_id = '#' THEN 0 ELSE 1 END")
    //             ->orderBy('id', 'asc')
    //             ->get();

    //         // Prepare a lookup array for menu items
    //         $menuMap = [];
    //         $formattedMenu = [];

    //         // First, group all menus by their ID for easy lookup
    //         foreach ($menus as $menu) {
    //             $menuMap[$menu->id] = [
    //                 'id' => $menu->id,
    //                 'parent_id' => $menu->parent_id,
    //                 'title' => $menu->title,
    //                 'desc' => $menu->desc,
    //                 'url' => $menu->url,
    //                 'icon' => $menu->icon,
    //                 'submenu' => [],
    //             ];
    //         }

    //         // Now, nest submenus under their respective parent
    //         foreach ($menuMap as $id => &$menu) {
    //             if (!empty($menu['parent_id']) && isset($menuMap[$menu['parent_id']])) {
    //                 $menuMap[$menu['parent_id']]['submenu'][] = &$menu;
    //             } else {
    //                 $formattedMenu[] = &$menu;
    //             }
    //         }

    //         // Share the formatted menu across all views
    //         $view->with('formattedMenu', $formattedMenu);
    //     });
    // }

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
