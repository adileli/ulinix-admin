<?php

namespace App\Http\Controllers\Admin;

use App\Model\AdminMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $menus = AdminMenu::all();

        return view('admin.menu.index');
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
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\AdminMenu  $adminMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminMenu $adminMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\AdminMenu  $adminMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminMenu $adminMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\AdminMenu  $adminMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminMenu $adminMenu)
    {
        //
    }
}
