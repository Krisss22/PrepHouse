<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $array)
 * @method static findOrFail(int|string $quizTagId)
 * @property mixed $use_all
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
        'use_all',
    ];

    public function isUseAll(): bool
    {
        return $this->use_all;
    }


    public function tag(): HasOne
    {
        return $this->hasOne('App\Models\Tag', 'id', 'tag_id');
    }
}
