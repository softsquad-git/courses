<?php

namespace App\Traits;

use App\Models\Users\UserVerificationEmail;
use Illuminate\Support\Str;

trait VerificationTrait
{
    /**
     * @param int $limit
     * @return string
     */
    public function generateToken($limit = 10): string
    {
        return Str::random($limit);
    }

    /**
     * @param string $token
     * @param string $email
     * @return string
     */
    public function saveToken(string $token, string $email): string
    {
        if ($verificationToken = $this->findToken($email)) {
            $this->deleteToken($verificationToken);
        }

        return UserVerificationEmail::create(['email' => $email, 'token' => $token]);
    }

    /**
     * @param string $email
     * @return UserVerificationEmail|null
     */
    public function findToken(string $email): ?UserVerificationEmail
    {
        return UserVerificationEmail::where(['email' => $email])->first();
    }

    /**
     * @param UserVerificationEmail $userVerificationEmail
     * @return bool|null
     */
    public function deleteToken(UserVerificationEmail $userVerificationEmail): ?bool
    {
        return $userVerificationEmail->delete();
    }

    /**
     * @param string $token
     * @param string|null $email
     * @return bool
     */
    public function checkToken(string $token, string $email = null): bool
    {
        if ($email) {
            if (UserVerificationEmail::where(['token' => $token, 'email' => $email])->first()) {
                return true;
            }

            return false;
        }

        if (UserVerificationEmail::where(['token' => $token])->first()) {
            return true;
        }

        return false;
    }

    /**
     * @param string $token
     * @return UserVerificationEmail|null
     */
    public function findByToken(string $token): ?UserVerificationEmail
    {
        return UserVerificationEmail::where(['token' => $token])->first();
    }
}
