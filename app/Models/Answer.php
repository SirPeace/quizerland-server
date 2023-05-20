<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function question(): BelongsTo
    {
        return $this->belongsTo('questions', 'question_id', 'id');
    }
}
