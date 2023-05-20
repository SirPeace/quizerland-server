<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Attributes as OA;

/**
 *
 * -------- Columns ---------
 * @property int        $id
 * @property string     $title
 * @property string     $description
 * @property int        $author_id
 *
 * -------- Relations ---------
 * @property Collection<Question>  $questions
 *
 */
#[OA\Schema(
    schema: 'QuizSchema',
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
        ),
        new OA\Property(
            property: 'title',
            type: 'string',
            example: 'Тест по географии',
        ),
        new OA\Property(
            property: 'description',
            type: 'string',
            example: 'Геогра́фия — комплекс естественных и общественных наук',
        ),
        new OA\Property(
            property: 'author_id',
            type: 'number',
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
        new OA\Property(
            property: 'questions',
            type: 'array',
            items: new OA\Items(ref: "#/components/schemas/QuestionSchema")
        ),
    ]
)]
class Quiz extends Model
{
    protected $guarded = [];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }
}
