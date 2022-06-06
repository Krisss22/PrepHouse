<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail($id)
 */
class SentQuestion extends Model
{
    use HasFactory;

    protected $table = 'sent_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'question',
        'answer',
        'email',
        'send_feedback',
    ];

    public function needFeedback(): bool
    {
        return (bool) $this->send_feedback;
    }

}
