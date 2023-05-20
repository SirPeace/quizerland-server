<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Attributes as OA;

/**
 *
 * -------- Columns ---------
 * @property int        $id
 * @property string     $text
 * @property int        $question_id
 *
 * -------- Relations ---------
 * @property Question   $question
 *
 */
#[OA\Schema(
    schema: 'AnswerSchema',
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
    ]
)]
class Answer extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo('questions', 'question_id', 'id');
    }
}
