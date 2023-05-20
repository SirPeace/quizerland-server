<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function correctAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'correct_answer_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
