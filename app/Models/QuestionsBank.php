<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array $array)
 * @method static create(array $array)
 */
class QuestionsBank extends Model
{
    use HasFactory;

    protected $table = 'questions_bank';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'addedByAdmin',
        'release',
        'answer',
        'tag_id',
    ];

    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }

    public function tag(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Tag', 'id', 'tag_id');
    }

    public function isReleased(): bool
    {
        return (bool) $this->release;
    }

    public function isAddedByAdmin(): bool
    {
        return (bool) $this->addedByAdmin;
    }

}
