<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static insert(array $array)
 * @method static create(array $array)
 * @method static findOrFail($id)
 * @property mixed $release
 * @property mixed $addedByAdmin
 */
class QuestionsBank extends Model
{
    use HasFactory;

    const IMAGES_PATH = 'images/questions';

    protected $table = 'questions_bank';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'question_image',
        'addedByAdmin',
        'release',
        'tag_id',
    ];

    static public function getRandomQuestionsByTagId($tagId, $limit)
    {
        return self::query()
            ->where('tag_id', '=', $tagId)
            ->where('release', '=', true)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function answers(): HasMany
    {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }

    public function tag(): HasOne
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
