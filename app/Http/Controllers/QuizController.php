<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quiz\CreateRequest;
use App\Http\Requests\Quiz\IndexRequest;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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

    #[OA\Get(
        tags: ['Тесты'],
        path: '/api/quizzes/:id',
        summary: 'Тест',
        description: 'Получить тест по идентификатору',
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'Идентификатор теста',
                in: 'path',
                schema: new OA\Schema(type: 'integer'),
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            ref: "#/components/schemas/QuizSchema"
        )
    )]
    public function show(Quiz $quiz): JsonResponse
    {
        return new JsonResponse($quiz);
    }

    #[OA\Post(
        tags: ['Тесты'],
        path: '/api/quizzes',
        summary: 'Создать тест',
        description: 'Создать тест',
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(ref: "#/components/schemas/QuizCreateRequest")
        ),
    )]
    #[OA\Response(
        response: 201,
        description: 'OK',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'id', type: 'integer'),
        ])
    )]
    public function store(CreateRequest $request): JsonResponse
    {
        DB::beginTransaction();

        /** @var Quiz $quiz */
        $quiz = Quiz::query()->create([
            'title' => $request->title,
            'description' => $request->description,
            'author_id' => auth()->id(),
        ]);

        $request_questions = $request->validated('questions');
        foreach ($request_questions as $request_question) {
            /** @var Question $question */
            $question = $quiz->questions()->create([
                'text' => $request_question['text']
            ]);

            $answers = $question->answers()->createMany(array_map(
                fn ($answer) => ['text' => $answer],
                $request_question['answers']
            ));

            $question->correctAnswer()->associate(
                $answers->get($request_question['correct_answer_index'])
            );
            $question->save();
        }

        DB::commit();

        return new JsonResponse(
            ['id' => $quiz->id],
            JsonResponse::HTTP_CREATED
        );
    }
}
