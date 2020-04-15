<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    private $tableName = 'configs';

    public function uploadLogo(Request $request)
    {
        if ($request->hasFile('file')) {
            $picture = $request->file('file');
            if (!$picture->isValid()) {
                abort(400);
            }
            $oldPicture = Arr::get(configs(), 'logo', false);
            if ($oldPicture) {
                $oldPicture = Str::after($oldPicture, '/storage/');
                Storage::disk('public')->delete($oldPicture);
            }

            $fileName = 'logo.'.$picture->getClientOriginalExtension();

            // 图片保存路径
            $savePath = 'system/' . $fileName;
            // Web 访问路径
            $webPath = '/storage/' . $savePath;
            // 否则执行保存操作，保存成功将访问路径返回给调用方
            if ($picture->storeAs('system', $fileName, ['disk' => 'public'])) {
                DB::table($this->tableName)->where('name', 'logo')->update(['value' => $webPath, 'updated_at' => time()]);

                return response()->json(compact('webPath','savePath'));
            }
            abort(500);
        } else {
            abort(400);
        }
    }

    public function index()
    {
        $setting = configs();

        return view('admin.config.index', ['setting' => $setting]);
    }

    public function store(Request $request)
    {
        $fields = $request->only(['site_name', 'url', 'logo', 'keywords', 'description']);
        foreach ($fields as $key => $field) {
            DB::table($this->tableName)->where('name', $key)->update(
                [
                    'value' => $field,
                    'updated_at' => time()
                ]
            );
        }
    }

    public function configs(Request $request)
    {
        $type = $request->get('type', 'system');
        $configs = DB::table($this->tableName)->where('type', $type)->get();
        $types = DB::table($this->tableName)->select('type')->distinct()->get()->pluck('type');

        return view('admin.config.configs', ['configs' => $configs, 'types' => $types]);
    }

    public function createConfigs(Request $request)
    {
        $type = $request->get('type', 'system');

        if ($request->isMethod('post')) {
            $fields = $request->only(['name', 'value', 'type', 'remark']);

            $fields['created_at'] = $fields['updated_at'] = time();

            $res = DB::table($this->tableName)->insert($fields);

            return response()->json($res);
        }

        return view('admin.config.create', ['type' => $type]);
    }

    public function deleteConfigs($id)
    {
        $result = DB::table($this->tableName)->delete($id);
        return response()->json($result);
    }

    public function storeConfigs(Request $request)
    {
        $fields = $request->all();
        $res = DB::table($this->tableName)->where('id', $fields['id'])->update([$fields['field'] => $fields['value'], 'updated_at' => time()]);

        return response()->json($res);
    }

    public function putConfigsFile()
    {
        $configsPath = config_path() . '/configs.php';
        $this->deleteConfigsFile();

        $configs = DB::table($this->tableName)->pluck('value', 'name')->toArray();
        File::put($configsPath, '<?php return '.var_export($configs, true).';'.PHP_EOL);

        $this->configCache();
    }

    public function deleteConfigsFile()
    {
        $configsPath = config_path() . '/configs.php';
        if (File::exists($configsPath)) {
            File::delete($configsPath);
        }
    }

    public function configCache()
    {
        Artisan::call('config:cache');
    }

    public function configClear()
    {
        Artisan::call('config:clear');
    }

    public function routeCache()
    {
        Artisan::call('route:cache');
    }

    public function routeClear()
    {
        Artisan::call('route:clear');
    }
}
