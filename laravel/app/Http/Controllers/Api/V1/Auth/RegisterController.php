<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Регистрация пользователя
     * также тут пройсходит и его аутификация
     * @return JsonResponse
     */
    public function register(RegisterFormRequest $request)
    {
        $user = User::create($request->all());

        // Авторизируем нового пользователя
        Auth::login($user);
        // Получаем нового пользователя
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
