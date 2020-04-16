<?php

use Illuminate\Support\Facades\DB;

if (! function_exists('configs')) {
    function configs($key = null)
    {
        if (config('configs')) {
            $configs = config('configs');
        } else {
            $configs = DB::table('configs')
                ->get()
                ->groupBy('type')
                ->map(function ($item) {
                    return $item->pluck('value', 'name')->all();
                })
                ->toArray();
        }

        return $key == null ? $configs : \Illuminate\Support\Arr::get($configs, $key) ?? '';
    }
}
