<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use OpenApi\Attributes as OA;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    #[OA\Post(
        tags: ["Авторизация"],
        path: "/register",
        summary: "Регистрация",
        description: "Регистрация нового пользователя в системе",
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(properties: [
                new OA\Property(
                    property: 'name',
                    type: 'string',
                    example: 'Jason Statham',
                ),
                new OA\Property(
                    property: 'email',
                    type: 'string',
                    example: 'fake@example.com',
                ),
                new OA\Property(
                    property: 'password',
                    type: 'string',
                    example: 'secure-password123',
                ),
                new OA\Property(
                    property: 'password_confirmation',
                    type: 'string',
                    example: 'secure-password123',
                ),
            ])
        )
    )]
    #[OA\Response(response: 200, description: 'OK')]
    #[OA\Response(response: 422, description: 'Невалидные данные')]
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
