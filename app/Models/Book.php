<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findORFail($bookId)
 * @method static create(array $array)
 */
class Book extends Model
{
    use HasFactory;

    const IMAGES_PATH = 'images/study/books';
    const FILES_PATH = 'files/study/books';

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'description',
        'image',
        'file',
        'topic_id',
    ];

    public function getFullPathImage(): string
    {
        return asset('storage/' . self::IMAGES_PATH . '/' . $this->image);
    }
}
