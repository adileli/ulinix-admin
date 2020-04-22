<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Auth\RegisterController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }
}
