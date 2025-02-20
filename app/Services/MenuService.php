namespace App\Services;

use App\Models\MenuModel;
use Illuminate\Support\Facades\Auth;

class MenuService
{
    public function getMenuByRole()
    {
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        $roleId = $user->roles->first()->id ?? null;

        if (!$roleId) {
            return [];
        }

        $menus = MenuModel::whereIn('id', function ($query) use ($roleId) {
            $query->select('menu')
                ->from('menu_assign')
                ->where('role_id', $roleId);
        })
            ->orderByRaw("CASE WHEN parent_id IS NULL OR parent_id = '#' THEN 0 ELSE 1 END")
            ->orderBy('id', 'asc')
            ->get();

        $menuMap = [];
        $formattedMenu = [];

        foreach ($menus as $menu) {
            $menuMap[$menu->id] = [
                'id' => $menu->id,
                'parent_id' => $menu->parent_id,
                'title' => $menu->title,
                'desc' => $menu->desc,
                'url' => $menu->url,
                'icon' => $menu->icon,
                'submenu' => [],
            ];
        }

        foreach ($menuMap as $id => &$menu) {
            if (!empty($menu['parent_id']) && isset($menuMap[$menu['parent_id']])) {
                $menuMap[$menu['parent_id']]['submenu'][] = &$menu;
            } else {
                $formattedMenu[] = &$menu;
            }
        }

        return $formattedMenu;
    }
}
