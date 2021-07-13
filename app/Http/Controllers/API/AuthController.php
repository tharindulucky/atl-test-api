<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return APIHelper::createErrorAPIResponse($validator->errors(), 400, 'error');
        }

        $validatedData['name'] = $request->name;
        $validatedData['email'] = $request->email;
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return APIHelper::createErrorAPIResponse($validator->errors(), 400, 'error');
        }

        $validatedData['email'] = $request->email;
        $validatedData['password'] = $request->password;

        if (!auth()->attempt($validatedData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }

}
