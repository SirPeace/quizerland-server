<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'QuizCreateRequest',
    properties: [
        new OA\Property(
            property: 'title',
            description: 'Название теста',
            type: 'string',
            example: 'Тест на знание анатомии'
        ),
        new OA\Property(
            property: 'description',
            description: 'Описание теста',
            type: 'string',
            example: 'Lorem ipsum dolor sit emmet'
        ),
        new OA\Property(
            property: 'questions',
            description: 'Вопросы',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/QuestionForQuizCreateRequest'),
        ),
    ]
)]
#[OA\Schema(
    schema: 'QuestionForQuizCreateRequest',
    properties: [
        new OA\Property(
            property: 'text',
            description: 'Текст вопроса',
            type: 'string',
            example: 'Какой орган человека похож на грецкий орех?'
        ),
        new OA\Property(
            property: 'correct_answer_index',
            description: 'Индекс правильного ответа',
            type: 'integer',
        ),
        new OA\Property(
            property: 'answers',
            description: 'Ответы',
            type: 'array',
            items: new OA\Items(type: 'string', example: 'Мозг'),
        ),
    ]
)]
class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],

            'questions' => ['required', 'array', 'min:1'],
            'questions.*.text' => ['required', 'string'],
            'questions.*.correct_answer_index' => ['required', 'integer', 'between:0,4'],
            'questions.*.answers' => ['required', 'array', 'size:5'],
            'questions.*.answers.*' => ['required', 'string'],
        ];
    }
}
