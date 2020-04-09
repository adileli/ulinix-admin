<?php

namespace App\Http\Controllers\Admin;

use App\Model\AdminMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminMenuController extends Controller
{
    private $tableName = 'admin_menus';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $menus = DB::table($this->tableName)->get();

        return view('admin.menu.index', ['menus' => $menus]);
    }

    public function create()
    {
        $menus = DB::table($this->tableName)->get();

        return view('admin.menu.create', ['menus' => $menus]);
    }

    public function store(Request $request)
    {
        $fields = $request->all();
        $fields['status'] = isset($fields['status']) ? 1 : 0;

        $request->validate([
            'title_ug' => 'required|max:255',
            'title_cn' => 'required|max:255',
            'href' => 'required',
            'pid' => 'required|integer',
            'target' => 'required',
            'sort' => 'required|integer',
        ]);

        $result = DB::table($this->tableName)->insert($fields);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\AdminMenu  $adminMenu
     * @return \Illuminate\Http\Response
     */
    public function show(AdminMenu $adminMenu)
    {
        //
    }

    public function edit($id)
    {
        $menu = DB::table($this->tableName)->find($id);
        $menus = DB::table($this->tableName)->get();

        return view('admin.menu.edit', ['menus' => $menus, 'menu' => $menu]);
    }

    public function update(Request $request, $id)
    {
        $fields = $request->all();
        $fields['status'] = isset($fields['status']) ? 1 : 0;

        $request->validate([
            'title_ug' => 'required|max:255',
            'title_cn' => 'required|max:255',
            'href' => 'required',
            'pid' => 'required|integer',
            'target' => 'required',
            'sort' => 'required|integer',
        ]);

        $result = DB::table($this->tableName)
            ->where('id', $id)
            ->update($fields);

        return response()->json($result);
    }

    public function destroy($id)
    {
        $result = DB::table($this->tableName)->delete($id);
        DB::table($this->tableName)->where('pid', '=', $id)->delete();
        return response()->json($result);
    }
}
