<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\AdminMenu;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AdminsController extends Controller
{
    private $tableName = 'admins';

    public function index()
    {
        $admins = DB::table($this->tableName)->get();

        return view('admin.admins.index', ['admins' => $admins]);
    }


    public function create(Router $router)
    {
        $menus = DB::table('admin_menus')->select('*')->where('status', 1)->orderBy('sort', 'desc')->get();
        $menus = AdminMenu::buildMenuChild(0, $menus);

        return view('admin.admins.create', ['menus' => $menus]);
    }

    public function store(Request $request)
    {
        $fields = $request->all();

        $cols = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            Admin::CREATED_AT => '',
            Admin::UPDATED_AT => '',
        ];
        $request->validate($cols);
        $fields['password'] = bcrypt($fields['password']);
        $fields[Admin::CREATED_AT] = $fields[Admin::UPDATED_AT] = time();

        if (isset($fields['is_super_admin'])) {
            $fields['is_super_admin'] = true;
            $cols['is_super_admin'] = 'required';
        }

        $result = DB::table($this->tableName)->insertGetId(Arr::only($fields, array_keys($cols)));

        if (isset($fields['permission']) && !empty($fields['permission'])) {
            DB::table('admin_permissions')
                ->where('admin_id', $result)
                ->updateOrInsert(
                    ['admin_id' => $result],
                    ['menu_ids' => implode('|', array_keys($fields['permission']))]
                );
        }

        return response()->json($result);
    }

    public function edit($id)
    {
        $admin = DB::table($this->tableName)->find($id);
        $menus = DB::table('admin_menus')->select('*')->where('status', 1)->orderBy('sort', 'desc')->get();
        $permissions = DB::table('admin_permissions')->where('admin_id', $id)->first();
        if ($permissions) {
            $permissions = explode('|', $permissions['menu_ids']);
        } else {
            $permissions = [];
        }

        $menus = AdminMenu::buildMenuChild(0, $menus);

        return view('admin.admins.edit', ['admin' => $admin, 'menus' => $menus, 'permissions' => $permissions]);
    }

    public function update(Request $request, $id)
    {
        $fields = $request->all();

        $cols = [
            'name' => 'required',
            'email' => 'required|email',
            Admin::UPDATED_AT => '',
        ];
        $request->validate($cols);
        if (isset($fields['password']) && !empty($fields['password'])) {
            $fields['password'] = bcrypt($fields['password']);
            $cols['password'] = 'required';
        }

        if (isset($fields['is_super_admin'])) {
            $fields['is_super_admin'] = true;
            $cols['is_super_admin'] = 'required';
        } else {
            $fields['is_super_admin'] = false;
            $cols['is_super_admin'] = 'required';
        }

        $fields[Admin::UPDATED_AT] = time();

        $result = DB::table($this->tableName)
            ->where('id', $id)
            ->update(Arr::only($fields, array_keys($cols)));

        if (isset($fields['permission']) && !empty($fields['permission'])) {
            DB::table('admin_permissions')
                ->where('admin_id', $id)
                ->updateOrInsert(
                    ['admin_id' => $id],
                    ['menu_ids' => implode('|', array_keys($fields['permission']))]
                );
        }

        return response()->json($result);
    }

    public function destroy($id)
    {
        $result = DB::table($this->tableName)->delete($id);
        return response()->json($result);
    }
}
