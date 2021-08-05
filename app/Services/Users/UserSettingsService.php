<?php

namespace App\Services\Users;

use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;
use \Exception;

class UserSettingsService
{
    /**
     * @param User $user
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function passwordUpdate(User $user, array $data): User
    {
        if (!Hash::check($data['old_password'], $user->password)) {
            throw new Exception('Podane hasło jest nieprawidłowe');
        }

        $user->update([
            'password' => Hash::make($data['new_password'])
        ]);

        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }
}
