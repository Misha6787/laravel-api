<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Авторизация пользователя
     * @return JsonResponse
     */
    public function login(LoginFormRequest $request)
    {
        // Получаем отправленные данные - почту и пароль
        $credentials = $request->all();
        // Аутификация пользователя, ищем пользователя в базе данных, если не находим или неправильный пароль отправляем ошибку
        // также если пользователь был найден то авторизируем его
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }
        // Получаем авторизированного пользователя
        $auth = Auth::user();
        // Создаем новый токен доступа для пользователя
        $token = $auth->createToken(config('app.name'));

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->plainTextToken,
            'user' => $auth,
        ], 200);
    }
}
