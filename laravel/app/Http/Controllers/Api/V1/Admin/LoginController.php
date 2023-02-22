<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        return Hash::check($request->password, $user->password);

//        if (Hash::check($pass, User::find(4)->password)) {
//            return 1;
//        } else {
//            return 0;
//        }

//        $request->validate([
//                'email' => ['required', 'string', 'max:255'],
//                'password' => ['required', 'string'],
//            ]);
//
//        $credentials = $request->only('email', 'password');
//        if (Auth::attempt($credentials)) {
//            // Authentication passed...
//           return response()->json([
//               'message' => 'Logged in Successfully.'
//           ], 201);
//        }
//        else{
//            throw ValidationException::withMessages([
//                'email' => 'Invalid Credentials'
//            ]);
//        }
    }
    public function logout()
    {
       if(auth()->check()){
        auth()->logout();
        return "Logged Out";
       }
    }
}
