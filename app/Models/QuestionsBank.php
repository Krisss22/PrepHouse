<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsBank extends Model
{
    use HasFactory;

    protected $table = 'questions_bank';

    public function vacancy()
    {
        return $this->belongsTo('App\Models\Vacancy', 'job_vacancy', 'id');
    }

}
