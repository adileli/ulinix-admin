<?php

use Illuminate\Database\Seeder;
use App\Model\AdminMenu;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sysMenu = new AdminMenu();
        $sysMenu->title_ug = 'تەڭشەش';
        $sysMenu->title_cn = '设置';
        $sysMenu->icon = 'fa fa-gears';
        $sysMenu->href = 'admin';
        $sysMenu->save();

        $manageMenu = new AdminMenu();
        $manageMenu->pid = $sysMenu->id;
        $manageMenu->title_ug = 'سەھىپە باشقۇرۇش';
        $manageMenu->title_cn = '菜单管理';
        $manageMenu->icon = 'fa fa-window-maximize';
        $manageMenu->href = 'admin/menus';
        $manageMenu->save();

        $settingMenu = new AdminMenu();
        $settingMenu->pid = $sysMenu->id;
        $settingMenu->title_ug = 'بەت باشقۇرۇش';
        $settingMenu->title_cn = '站点设置';
        $settingMenu->icon = 'fa fa-sliders';
        $settingMenu->href = 'admin/setting';
        $settingMenu->save();

    }
}
