<?php

use Illuminate\Support\Facades\DB;

if (! function_exists('configs')) {
    function configs($key = null)
    {
        if (config('configs')) {
            $configs = config('configs');
        } else {
            $configs = DB::table('configs')->pluck('value', 'name')->toArray();
        }

        return $key == null ? $configs : $configs[$key] ?? '';
    }
}
