<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail(int $interviewRequestId)
 */
class InterviewRequest extends Model
{
    use HasFactory;

    const STATUS_CREATED = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_DONE = 2;

    protected $table = 'interview_requests';

    protected $fillable = [
        'name',
        'email',
        'text',
        'status',
        'user_id',
    ];

    public function getStatusName(int $statusIndex): string
    {
        switch ($statusIndex) {
            case self::STATUS_IN_PROGRESS:
                return 'In progress';
            case self::STATUS_DONE:
                return 'Done';
            default:
                return 'Created';
        }
    }

    /**
     * @return bool
     */
    public function isHighestStatus(): bool
    {
        return $this->status === self::STATUS_DONE;
    }

    /**
     * @return bool
     */
    public function isLowestStatus(): bool
    {
        return $this->status === self::STATUS_CREATED;
    }

    public function getHigherStatus(): int
    {
        return $this->isHighestStatus() ? self::STATUS_DONE : $this->status + 1;
    }

    public function getLowerStatus(): int
    {
        return $this->isLowestStatus() ? self::STATUS_CREATED : $this->status - 1;
    }
}
