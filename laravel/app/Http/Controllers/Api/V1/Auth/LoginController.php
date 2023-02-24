<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     */
    public function login(Request $request)
    {
//        return $request;
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $auth = Auth::user();

        $token = $auth->createToken(config('app.name'));

//            $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'user' => $auth,
        ], 200);

            //$request->session()->regenerate();

            // Auth::user() === $request->user()

//            $token = $request->user()->createToken();


//            $auth = Auth::user();
//
//            $token = $auth->createToken(config('app.name'));
////            $token->token->expires_at = $request->remember_me ?
////                Carbon::now()->addMonth() :
////                Carbon::now()->addDay();
//
//            $token->token->save();
//
//            return response()->json([
//                'token_type' => 'Bearer',
//                'token' => $token->accessToken,
//                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
//                'user' => $auth,
//            ], 200);



//        $this->middleware('guest')->except('logout');

//        if (!Auth::attempt($request->only('email', 'password'))) {
//            return response()->json([
//                'message' => 'Invalid login details'
//            ], 204);
//        }
//        $request->session()->regenerate();
//        return [];


//        $user = User::where('email', $request->email)->first();
//
//        return Hash::check($request->password, $user->password);







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
