<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quiz\IndexRequest;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class QuizController extends Controller
{
    #[OA\Get(
        tags: ['Тесты'],
        path: '/api/quizzes',
        summary: 'Список тестов',
        description: 'Получить список тестов с пагинацией',
        parameters: [
            new OA\Parameter(
                name: 'cursor',
                description: 'Хеш для получения следующего блока тестов',
                in: 'query',
                schema: new OA\Schema(type: 'string', example: '$2fssfhu9ewagh97e9aus90few09ayfds9fa'),
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(properties: [
            new OA\Property(
                property: 'next_cursor',
                type: 'string',
                nullable: true,
                example: '$2fssfhu9ewagh97e9aus90few09ayfds9fa'
            ),
            new OA\Property(
                property: 'per_page',
                type: 'integer',
                example: 15,
            ),
            new OA\Property(
                property: 'data',
                type: 'array',
                items: new OA\Items(ref: "#/components/schemas/QuizSchema")
            )
        ])
    )]
    public function index(IndexRequest $request): JsonResponse
    {
        $paginated_quizzes = Quiz::query()
            ->with('questions.answers')
            ->cursorPaginate();

        return new JsonResponse($paginated_quizzes);
    }
}
