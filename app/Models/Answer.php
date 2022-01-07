<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array $array)
 * @method static create(array $array)
 * @method static findOrFail(int|string $answerId)
 */
class Answer extends Model
{
    use HasFactory;

    const IMAGES_PATH = 'images/answers';

    protected $table = 'question_answers';

    protected $fillable = [
        'image',
        'text',
        'question_id',
        'correct'
    ];
}
