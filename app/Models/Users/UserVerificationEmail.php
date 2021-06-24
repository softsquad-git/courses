<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Users
 * @property string email
 * @property string token
 */
class UserVerificationEmail extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'verification_code';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'email',
        'token'
    ];

    /**
     * @return User|null
     */
    public function user(): ?User
    {
        return User::where('email', $this->email)->first();
    }
}
