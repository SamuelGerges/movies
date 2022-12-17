<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data['user'] = new UserResource($user);
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;

            return response()->api($data);
        } else {

            return response()->api([], 1, __('auth.failed'));

        }//end of else
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required|min:4'
        ]);

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }


        $user = User::create(array_merge($validator->validated(), [
            'type' => 'user',
        ]));

        $data['user'] = new UserResource($user);
        $data['token'] = $user->createToken('my-app-token')->plainTextToken;
        return response()->api($data);

    }

    public function userData()
    {
        $data['user'] = new UserResource(auth()->user('sanctum'));
        return response()->api($data);

    }
}
