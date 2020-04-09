<?php

namespace App\Http\Controllers\Admin;

use App\Model\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function uploadLogo(Request $request)
    {
        if ($request->hasFile('file')) {
            $picture = $request->file('file');
            if (!$picture->isValid()) {
                abort(400);
            }
            $setting = Config::where('name', 'setting')->first();
            $oldPicture = Arr::get($setting, 'value.logo', false);
            if ($oldPicture) {
                $oldPicture = Str::after($oldPicture, '/storage/');
                Storage::disk('public')->delete($oldPicture);
            }

            $fileName = 'logo.'.$picture->getClientOriginalExtension();

            // 图片保存路径
            $savePath = 'system/' . $fileName;
            // Web 访问路径
            $webPath = '/storage/' . $savePath;
            if (Storage::disk('public')->has($savePath)) {
                Storage::delete($savePath);
            }
            // 否则执行保存操作，保存成功将访问路径返回给调用方
            if ($picture->storePubliclyAs('system', $fileName, ['disk' => 'public'])) {
                $setting->value = array_merge($setting->value, ['logo' => $webPath]);
                $setting->save();
                return response()->json(compact('webPath','savePath'));
            }
            abort(500);
        } else {
            abort(400);
        }
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
