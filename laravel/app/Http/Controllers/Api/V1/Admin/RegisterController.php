<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterFormRequest;
use App\Http\Resources\V1\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterFormRequest $request)
    {

//        return [
//            Hash::make($request->password)
//        ];
        $user = new RegisterResource(User::create($request->all()));

//        User::create($request->all());

        return response()->json([
            'message' => 'Поздравляем с регистрацией!',
            'user' => $user
        ], 200);

//        $data = $request->all();
//        return response()->json($data);
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:4', 'confirmed'],
        // ]);
    }
    public function users()
    {
        $users = User::all();
        return response()->json($users);
    }
}
