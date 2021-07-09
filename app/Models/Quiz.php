<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail($id)
 */
class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'topic_id',
    ];

    public function topic()
    {
        return $this->hasOne('App\Models\Topic', 'id', 'topic_id');
    }

    public function quizTags()
    {
        return $this->hasMany('App\Models\QuizTag', 'quiz_id', 'id');
    }

    public function getAllQuesionsCount(): int
    {
        $count = 0;
        foreach ($this->quizTags as $quizTag) {
            $count += $quizTag->count;
        }
        return $count;
    }
}
