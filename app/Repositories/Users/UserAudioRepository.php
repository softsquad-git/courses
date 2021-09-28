<?php

namespace App\Repositories\Users;

use App\Models\Users\User;
use App\Models\Users\UserAudio;
use Illuminate\Database\Eloquent\Collection;

class UserAudioRepository
{
    /**
     * @param int $id
     * @return UserAudio|null
     */
    public function find(int $id): ?UserAudio
    {
        return UserAudio::find($id);
    }

    /**
     * @param array $filters
     * @return Collection|array
     */
    public function findBy(array $filters): Collection|array
    {
        $data = UserAudio::orderBy('id', 'DESC');

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }

        if (isset($filters['lesson_id']) && !empty($filters['lesson_id'])) {
            $data->where('lesson_id', $filters['lesson_id']);
        }

        return $data->get();
    }

    /**
     * @param array $filters
     * @return UserAudio|null
     */
    public function findByOne(array $filters): ?UserAudio
    {
        return UserAudio::where($filters)->first();
    }
}
