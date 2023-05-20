<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
class Quiz extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }
}
