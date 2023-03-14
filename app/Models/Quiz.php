<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

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

        $whereQuery = "";
        if ($onlyInRelease) {
            $whereQuery = "and qb.release = 1";
        }

        $query = "select qt.count, qt.use_all, (select count(qb.id) from questions_bank qb where qb.tag_id = qt.tag_id $whereQuery) all_questions from quiz_tag qt where qt.tag_id in (?) and qt.quiz_id = ?";
        $rows = DB::select($query, [implode(',', $tagIds), $this->id]);

        $count = 0;
        foreach ($rows as $row) {
            if ($row->use_all) {
                $count +=  $row->all_questions;
            } else {
                $count +=  $row->count;
            }
        }

        return $count;
    }
}

