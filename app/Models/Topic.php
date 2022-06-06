<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail(int $id)
 */
class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function sites()
    {
        return $this->hasMany('App\Models\Site', 'topic_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany('App\Models\Video', 'topic_id', 'id');
    }

    public function books()
    {
        return $this->hasMany('App\Models\Book', 'topic_id', 'id');
    }

    public function materials()
    {
        return $this->hasMany('App\Models\Material', 'topic_id', 'id');
    }
}
