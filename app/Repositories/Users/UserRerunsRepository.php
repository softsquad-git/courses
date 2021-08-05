<?php

namespace App\Repositories\Users;

use App\Models\Users\UserRerun;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRerunsRepository extends Repository
{
    /**
     * @param UserRerun $userRerun
     */
    public function __construct(UserRerun $userRerun)
    {
        $this->model = $userRerun;
    }

    /**
     * @param array $filters
     * @param bool $isAll
     * @return Collection|array|LengthAwarePaginator
     */
    public function findBy(array $filters, bool $isAll = false): Collection|array|LengthAwarePaginator
    {
        $data = $this->model::orderBy('id', 'DESC');

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $data->where(['user_id' => $filters['user_id']]);
        }

        if ($isAll) {
            return $data->get();
        }

        return $data->paginate(20);
    }
}
