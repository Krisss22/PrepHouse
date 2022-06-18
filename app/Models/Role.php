<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @method static create(array $array)
 * @method static findOrFail($roleId)
 */
class Role extends Model
{
    use HasFactory;

    /**
     * Number 0
     */
    public const accessDenied = '0';
    /**
     * Number 1
     */
    public const accessOnlyMe = '1';
    /**
     * Number 2
     */
    public const accessOnlyMyRole = '2';
    /**
     * Number 3
     */
    public const accessAll = '3';

    public const showAccessType = 'show';
    public const createAccessType = 'create';
    public const updateAccessType = 'update';
    public const deleteAccessType = 'delete';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "roles_permissions",
        "users_permissions",
        "topics_permissions",
        "tags_permissions",
        "questions_permissions",
        "quizzes_permissions",
        "study_books_permissions",
        "study_materials_permissions",
        "study_videos_permissions",
        "study_sites_permissions",
        "vacancies_permissions",
        "sent_questions_permissions",
    ];

    /**
     * @param string $sector
     * @param string|null $accessType
     * @return string
     */
    public function getSectorAccess(string $sector, string $accessType = null): string
    {
        $access = $this->{$sector . '_permissions'} ?? '0000';
        if ($accessType) {
            switch ($accessType) {
                case self::showAccessType:
                    return $access[0] ?? '0';
                case self::createAccessType:
                    return $access[1] ?? '1';
                case self::updateAccessType:
                    return $access[2] ?? '2';
                case self::deleteAccessType:
                    return $access[3] ?? '3';
            }
        }

        return $access;
    }

    /**
     * @param string $sector
     * @param string $accessType
     * @param User|null $userForCompare
     * @return bool
     */
    public function checkAccess(string $sector, string $accessType, User $userForCompare = null): bool
    {
        $access = $this->getSectorAccess($sector, $accessType);
        switch ($access) {
            case self::accessDenied:
                return false;
            case self::accessOnlyMe:
                return $userForCompare->id === Auth::user()->id;
            case self::accessOnlyMyRole:
                return $userForCompare->userRole->id === Auth::user()->userRole->id;
            default:
                return true;
        }
    }
}
