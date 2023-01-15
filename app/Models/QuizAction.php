<?php

namespace App\Models;

use App\Services\Quiz\QuizData;
use App\Services\Quiz\QuizService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

/**
 * @method static create(array $array)
 * @method static where()
 * @method static select(string $string)
 * @method static find(int $unloggedQuizActionId)
 * @method static findOrFail($quizActionId)
 * @property mixed $finished
 * @property mixed $data
 */
class QuizAction extends Model
{
    use HasFactory;

    protected $table = 'quiz_action';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quiz_id',
        'user_id',
        'data',
        'finished',
        'passed',
    ];

    public function quiz(): HasOne
    {
        return $this->hasOne('App\Models\Quiz', 'id', 'quiz_id');
    }

    public function isFinished(): bool
    {
        return (bool) $this->finished;
    }

    public function getData(): QuizData
    {
        return new QuizData(json_decode($this->data, true));
    }

    public function getStartDate(): string
    {

        return $this->created_at->format('M d, Y');
    }

    static public function getLastUserQuizById(int $quizId)
    {
        $query = self::query()
            ->select('quiz_action.*', 'quizzes.id as quizzes_id')
            ->leftJoin('quizzes', 'quiz_action.quiz_id', '=', 'quizzes.id')
            ->where('quizzes.id', $quizId)
            ->where('finished', 0)
            ->orderByDesc('quiz_action.id');

        return Auth::check() ?
            $query->where('user_id', Auth::user()->id)->first()
            :
            $query->whereIn('quiz_action.id', QuizService::getUnloggedQuizActionIds())->first();
    }

    static public function getAllUserQuizzesQuery($userId, $finished = false): Builder
    {
        $query = self::query()
            ->where('user_id', '=', $userId);

        if ($finished) {
            $query->where('finished', '=', 1);
        }

        return $query;
    }

}
