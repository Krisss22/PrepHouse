<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail(int|string $quizTagId)
 */
class QuizTag extends Model
{
    use HasFactory;

    protected $table = 'quiz_tag';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quiz_id',
        'tag_id',
        'count',
    ];

    public function tag()
    {
        return $this->hasOne('App\Models\Tag', 'id', 'tag_id');
    }
}
