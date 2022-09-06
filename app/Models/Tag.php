<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail($id)
 */
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function questions()
    {
        return $this->hasMany('App\Models\QuestionsBank', 'tag_id', 'id');
    }

    public function questionsInRelease(): int
    {
        $inReleaseCount = 0;
        foreach ($this->questions as $question) {
            if ($question->release) {
                $inReleaseCount++;
            }
        }

        return $inReleaseCount;
    }
}
