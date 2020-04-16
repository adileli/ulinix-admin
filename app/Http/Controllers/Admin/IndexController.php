<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\AdminMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function admin()
    {
        $setting = configs();

        return view('layouts.admin', ['setting' => $setting]);
    }

    public function index()
    {
        return view('admin.index');
    }

    public function changeLocale(Request $request, $locale)
    {
        $user = Admin::find($request->user('admin')->id);
        $user->locale = $locale;
        $user->save();

        return response()->json('success');
    }

    public function getSystemInit(){
        $setting = configs();

        $homeInfo = [
            'title' => trans('admin.homepage'),
            'href'  => route('admin.index'),
        ];
        $logoInfo = [
            'title' => Arr::get($setting, 'system.site_name', config('app.name')),
            'image' => asset(Arr::get($setting, 'system.logo', 'images/logo.png')),
        ];
        $menuInfo = $this->getMenuList();
        $systemInit = [
            'homeInfo' => $homeInfo,
            'logoInfo' => $logoInfo,
            'menuInfo' => $menuInfo,
        ];
        return response()->json($systemInit);
    }

    // 获取菜单列表
    private function getMenuList(){
        $admin = Auth::guard('admin')->user();
        $permission = DB::table('admin_permissions')
            ->where('admin_id', $admin->id)
            ->first();
        $menuIds = [];
        if (!empty($permission['menu_ids'])) {
            $menuIds = explode('|', $permission['menu_ids']);
        }

        $menuList = DB::table('admin_menus')
            ->select('*')
            ->where('status', 1)
            ->orderBy('sort', 'desc');

        if ($menuIds) {
            $menuList->whereIn('id', $menuIds);
        }

        $menuList = $menuList->get();

        $menuList = AdminMenu::buildMenuChild(0, $menuList);
        return $menuList;
    }
}
