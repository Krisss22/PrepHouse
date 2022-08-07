<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($getInputsFromRequest)
 * @method static findOrFail(int $landingId)
 */
class Landing extends Model
{
    use HasFactory;

    protected $table = 'landings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
    ];
}
