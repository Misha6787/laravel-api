<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterFormRequest;
use App\Http\Resources\V1\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
//        $user = new RegisterResource();


        $user = User::create($request->all());

        Auth::login($user);

        $auth = Auth::user();

        $token = $auth->createToken(config('app.name'));

//            $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->plainTextToken,
            'user' => $auth,
        ], 200);
    }
    public function users()
    {
        $users = User::all();
        return response()->json($users);
    }
}
