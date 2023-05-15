<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function correctAnswer(): BelongsTo
    {
        return $this->belongsTo('answers', 'correct_answer_id', 'id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany('answers', 'question_id', 'id');
    }
}
