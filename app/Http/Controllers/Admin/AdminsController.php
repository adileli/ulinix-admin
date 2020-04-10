<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class AdminsController extends Controller
{
    private $tableName = 'admins';

    public function index()
    {
        $admins = DB::table($this->tableName)->get();

        return view('admin.admins.index', ['admins' => $admins]);
    }


    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $fields = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $fields['password'] = bcrypt($fields['password']);
        $fields[Admin::CREATED_AT] = $fields[Admin::UPDATED_AT] = Date::now();

        $result = DB::table($this->tableName)->insert($fields);

        return response()->json($result);
    }

    public function edit($id)
    {
        $admin = DB::table($this->tableName)->find($id);

        return view('admin.admins.edit', ['admin' => $admin]);
    }

    public function update(Request $request, $id)
    {
        $fields = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $fields['password'] = bcrypt($fields['password']);
        $fields[Admin::UPDATED_AT] = Date::now();

        $result = DB::table($this->tableName)
            ->where('id', $id)
            ->update($fields);

        return response()->json($result);
    }

    public function destroy($id)
    {
        $result = DB::table($this->tableName)->delete($id);
        return response()->json($result);
    }
}
