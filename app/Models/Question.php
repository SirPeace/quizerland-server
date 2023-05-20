<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Attributes as OA;

/**
 *
 * -------- Columns ---------
 * @property int       $id
 * @property string    $text
 * @property int       $quiz_id
 * @property ?int      $correct_answer_id
 *
 * -------- Relations ---------
 * @property Collection<Answer>  $answers
 * @property ?Answer             $correctAnswer
 *
 */
#[OA\Schema(
    schema: 'QuestionSchema',
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
        ),
        new OA\Property(
            property: 'text',
            type: 'string',
            example: 'Текст ответа...',
        ),
        new OA\Property(
            property: 'correct_answer_id',
            type: 'number',
        ),
        new OA\Property(
            property: 'answers',
            type: 'array',
            items: new OA\Items(ref: "#/components/schemas/AnswerSchema")
        ),
    ]
)]
class Question extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function correctAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'correct_answer_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
