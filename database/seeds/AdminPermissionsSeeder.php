<?php

use Illuminate\Database\Seeder;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Model\Admin::where('name', 'admin')->first();
        $menus = \App\Model\AdminMenu::all('id');
        $menuIds = \Illuminate\Support\Arr::flatten($menus->toArray());

        $fields = [
            'admin_id' => $admin->id,
            'menu_ids' => implode('|', $menuIds)
        ];

        \Illuminate\Support\Facades\DB::table('admin_permissions')->insert($fields);
    }
}
