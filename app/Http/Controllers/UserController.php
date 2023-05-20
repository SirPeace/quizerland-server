<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    #[OA\Post(
        tags: ["Авторизация"],
        path: "/api/user",
        summary: "Пользователь",
        description: "Получить данные авторизованного пользователя",
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'id',
                    type: 'integer',
                ),
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
                    property: 'created_at',
                    type: 'string',
                    example: '2023-05-20T12:45:00.000000Z'
                ),
                new OA\Property(
                    property: 'updated_at',
                    type: 'string',
                    example: '2023-05-20T12:45:00.000000Z'
                ),
            ]
        )
    )]
    #[OA\Response(
        response: 401,
        description: 'Пользователь не авторизован'
    )]
    public function show(Request $request): JsonResponse
    {
        return new JsonResponse($request->user());
    }
}
