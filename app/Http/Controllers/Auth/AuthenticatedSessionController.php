<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OA;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    #[OA\Post(
        tags: ["Авторизация"],
        path: "/login",
        summary: "Вход",
        description: "Вход в систему по логину и паролю",
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(properties: [
                new OA\Property(
                    property: 'email',
                    type: 'string',
                    example: 'admin@example.com',
                ),
                new OA\Property(
                    property: 'password',
                    type: 'string',
                    example: 'password',
                ),
            ])
        )
    )]
    #[OA\Response(response: 200, description: 'OK')]
    #[OA\Response(response: 422, description: 'Неверный логин и/или пароль')]
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    #[OA\Post(
        tags: ["Авторизация"],
        path: "/logout",
        summary: "Выход",
        description: "Выход из системы",
    )]
    #[OA\Response(response: 200, description: 'OK')]
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
