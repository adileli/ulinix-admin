<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class CheckTakeRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws HttpResponseException
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $permission = DB::table('admin_permissions')
                        ->where('admin_id', $request->user()->id)
                        ->first();
        $menuIds = [];
        if (!empty($permission->menu_ids)) {
            $menuIds = explode('|', $permission->menu_ids);
        }

        $menus = DB::table('admin_menus')
                    ->select('href');
        if ($menuIds) {
            $menus->whereIn('id', $menuIds);
        }
        $menus = $menus->get();
        if ($menus->whereIn('href', $request->path())->isEmpty()) {
            abort(403);
        }

        return $response;
    }
}
