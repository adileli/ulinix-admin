<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('configs')->insert([
            ['name' => 'site_name', 'value' => \config('app.name'), 'created_at' => time(), 'updated_at' => time()],
            ['name' => 'logo', 'value' => 'images/logo.png', 'created_at' => time(), 'updated_at' => time()],
            ['name' => 'url', 'value' => \config('app.url'), 'created_at' => time(), 'updated_at' => time()],
            ['name' => 'keywords', 'value' => '', 'created_at' => time(), 'updated_at' => time()],
            ['name' => 'description', 'value' => '', 'created_at' => time(), 'updated_at' => time()],
        ]);
    }
}
