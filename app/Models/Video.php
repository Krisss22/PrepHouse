<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findORFail($videoId)
 * @method static create(array $array)
 */
class Video extends Model
{
    use HasFactory;

    const IMAGES_PATH = 'images/study/videos';

    protected $table = 'videos';

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'topic_id',
    ];

    public function getFullPathImage(): string
    {
        return asset('storage/' . self::IMAGES_PATH . '/' . $this->image);
    }
}
