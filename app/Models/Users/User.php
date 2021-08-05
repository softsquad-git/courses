<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @package App\Models\Users
 * @property string name
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string password
 * @property bool is_active
 * @property string role
 * @property bool is_terms
 * @property bool is_newsletter
 * @property string avatarImage
 * @method static orderBy(string $string, string $ordering)
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    /**
     * @var string[] $roles
     */
    public static array $roles = [
        'R_ADMIN' => 'R_ADMIN',
        'R_USER' => 'R_USER'
    ];

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/media/avatars/';

    use HasFactory, Notifiable, HasApiTokens;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_active',
        'role',
        'is_terms',
        'is_newsletter',
        'avatar'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var string[] $appends
     */
    protected $appends = [
        'name',
        'avatar_image'
    ];

    /**
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return string
     */
    public function getAvatarImageAttribute(): string
    {
        if ($this->avatar) {
            return asset(self::$fileDir.$this->avatar);
        }

        return asset(self::$fileDir.'df.png');
    }

    /**
     * @return string
     */
    public function getIsActive(): string
    {
        return $this->is_active == 1 ? 'Tak' : 'Nie';
    }
}
