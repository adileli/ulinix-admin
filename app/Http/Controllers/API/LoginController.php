<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Auth\LoginController as BaseController;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where($this->username(), $request->get($this->username()))->firstOrFail();

        if (password_verify($request->get('password'), $user->getAuthPassword())) {

            return response()->json([
                'token' => $user->generateToken(),
                'user' => $user->toArray(),
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $user = $this->guard()->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data' => 'User logged out.'], 200);
    }

    protected function guard()
    {
        return Auth::guard('api');
    }

    public function username()
    {
        return 'name';
    }
}
