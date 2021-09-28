<?php

namespace App\Services\Users;

use App\Models\Users\UserAudio;
use Illuminate\Support\Facades\Auth;

class UserAudioService
{
    /**
     * @param array $data
     * @param UserAudio|null $userAudio
     * @return UserAudio
     */
    public function save(array $data, UserAudio $userAudio = null): UserAudio
    {
        $data['user_id'] = Auth::id();

        return UserAudio::create($data);
    }

    /**
     * @param UserAudio $userAudio
     * @return bool|null
     */
    public function remove(UserAudio $userAudio): ?bool
    {
        return $userAudio->delete();
    }
}
