<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 */
class Vacancy extends Model
{
    use HasFactory;

    protected $table = 'vacancies';

    public function questions()
    {
        return $this->hasMany('App\Models\QuestionsBank', 'job_vacancy', 'id');
    }
}
