<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findORFail($materialId)
 * @method static create(array $array)
 */
class Material extends Model
{
    use HasFactory;

    const IMAGES_PATH = 'images/study/materials';
    const FILES_PATH = 'files/study/materials';

    protected $table = 'materials';

    protected $fillable = [
        'title',
        'image',
        'file',
        'topic_id',
    ];

    public function getFullPathImage(): string
    {
        return asset('storage/' . self::IMAGES_PATH . '/' . $this->image);
    }

    public function getFullPathToFile(): string
    {
        return asset('storage/' . self::FILES_PATH . '/' . $this->file);
    }

    public function getFileMetaInfo(): string
    {
        return 'meta info';
    }
}
