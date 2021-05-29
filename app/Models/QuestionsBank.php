<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array $array)
 */
class QuestionsBank extends Model
{
    use HasFactory;

    protected $table = 'questions_bank';

    public function vacancy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Vacancy', 'job_vacancy', 'id');
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
