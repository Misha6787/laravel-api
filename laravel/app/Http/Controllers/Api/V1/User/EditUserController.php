<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class EditUserController extends Controller
{
    /**
     * Авторизация пользователя
     * @return JsonResponse
     */
    public function editUser(Request $request) {
//        $credentials = (object) [
//            'email' => $request->user()->id,
//            'password' => $userData['oldPassword'] ?? $request->user()->password,
//        ];

        $credentials = $request->all();

//        if (!User::all()->find($request->user()->id)) {
//            return response()->json([
//                'errors' => 'Unauthorised'
//            ], 401);
//        }

        if ($credentials['oldPassword']) {

            $test = [
                'email' => $request->user()->email,
                'password' => $credentials['oldPassword']
            ];

            if (!Auth::attempt(['email' => $request->user()->email, 'password' => $credentials['oldPassword']])) {
                return response()->json([
                    'message' => 'You cannot sign with those credentials',
                    'errors' => 'Unauthorised'
                ], 401);
            }
        }

        return response()->json([
            'mes' => $request->user()->id,
            'mes2' => $request->all()
//            'mes' => $request->all()
//            'mes' => User::all()->find(1);
        ]);
        // Аутификация пользователя, ищем пользователя в базе данных, если не находим или неправильный пароль отправляем ошибку
        // также если пользователь был найден то авторизируем его
//        if (!Auth::attempt($credentials)) {
//            return response()->json([
//                'message' => 'You cannot sign with those credentials',
//                'errors' => 'Unauthorised'
//            ], 401);
//        }

        return response()->json([
            'message' => 'User data change'
        ]);
    }
}
