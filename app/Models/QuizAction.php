<?php

namespace App\Models;

use App\Services\Quiz\QuizData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $array)
 * @method static findOrFail()
 * @method static where()
 * @method static select(string $string)
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

    static public function getLastUserQuiz()
    {
        return self::query()
            ->where('user_id', 1)
            ->where('finished', 0)
            ->orderByDesc('id')
            ->first();
    }
}
