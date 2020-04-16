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
            ['type' => 'system', 'name' => 'site_name', 'value' => \config('app.name'), 'title_ug' => 'توربەت نامى', 'title_cn' => '网站名称', 'created_at' => time(), 'updated_at' => time()],
            ['type' => 'system', 'name' => 'logo', 'value' => 'images/logo.png', 'title_ug' => 'توربەت رەسىمى', 'title_cn' => '网站图标', 'created_at' => time(), 'updated_at' => time()],
            ['type' => 'system', 'name' => 'url', 'value' => \config('app.url'), 'title_ug' => 'توربەت ئادرېس', 'title_cn' => '网站域名', 'created_at' => time(), 'updated_at' => time()],
            ['type' => 'system', 'name' => 'keywords', 'value' => '', 'title_ug' => 'ھالقىلىق سۆز META', 'title_cn' => 'META关键词', 'created_at' => time(), 'updated_at' => time()],
            ['type' => 'system', 'name' => 'description', 'value' => '', 'title_ug' => 'توربەت چۈشەندۈرۈش META', 'title_cn' => 'META描述', 'created_at' => time(), 'updated_at' => time()],
        ]);
    }
}
