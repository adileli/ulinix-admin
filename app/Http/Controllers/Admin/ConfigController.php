<?php

namespace App\Http\Controllers\Admin;

use App\Model\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function uploadLogo(Request $request)
    {
        $setting = Config::where('name', 'setting')->first();
        $logo = Arr::get($setting, 'value.logo', false);
        if ($logo) {
            Storage::delete($logo);
        }

        $file = $request->file('file');
        $fileName = 'logo.'.$file->getClientOriginalExtension();
        $file->storeAs('public/system', $fileName);
        $path = 'storage/system/'.$fileName;

        $setting->value = array_merge($setting->value, ['logo' => 'storage/system/'.$fileName]);
        $setting->save();
        return response()->json(['path' => $path]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $setting = Config::where('name', 'setting')->first();

        return view('admin.config.index', ['setting' => $setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $field = $request->all();
        Config::where('name', 'setting')->update(['value' => $field]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $config)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }
}
