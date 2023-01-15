<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'expertise_area_id',
    ];

    public function expertiseArea(): HasOne
    {
        return $this->hasOne('App\Models\ExpertiseArea', 'id', 'expertise_area_id');
    }

    public function topic(): HasOne
    {
        return $this->hasOne('App\Models\Topic', 'id', 'topic_id');
    }

    public function quizAction(): HasOne
    {
        return $this->hasOne('App\Models\QuizAction', 'quiz_id', 'id');
    }

    public function quizTags(): HasMany
    {
        return $this->hasMany('App\Models\QuizTag', 'quiz_id', 'id');
    }

    public function getAllQuestionsCount(bool $onlyInRelease = false): int
    {
        $tagIds = [];
        foreach ($this->quizTags as $quizTag) {
            $tagIds[] = $quizTag->tag_id;
        }

        $questionsBankQuery = QuestionsBank::query()
            ->whereIn("tag_id", $tagIds);

        if ($onlyInRelease) {
            $questionsBankQuery->where("release", "=", true);
        }

        $releasedQuestions = $questionsBankQuery->get();

        return count($releasedQuestions);
    }
}

