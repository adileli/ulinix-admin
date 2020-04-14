<?php

use Illuminate\Database\Seeder;
use App\Model\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admin = new Admin;
        $admin->name = 'admin';
        $admin->nickname = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('admin888');
        $admin->is_super_admin = true;

        $admin->save();
    }
}
