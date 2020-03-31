<?php

use Illuminate\Database\Seeder;
use App\Model\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sitename = new Config();
        $sitename->name = 'setting';
        $sitename->value = [
            'sitename' => \config('app.name'),
            'url' => \config('app.url'),
        ];
        $sitename->save();
    }
}
