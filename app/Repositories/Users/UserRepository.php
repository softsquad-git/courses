<?php

namespace App\Repositories\Users;

use App\Models\Users\User;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param array $filters
     * @param string $ordering
     * @param int $pagination
     * @param int $limit
     * @return Collection|LengthAwarePaginator|array
     */
    public function findBy(
        array $filters,
        string $ordering = 'DESC',
        int $pagination = 20,
        int $limit = 0
    ): Collection|LengthAwarePaginator|array
    {
        $data = $this->model::orderBy('id', $ordering);

        if (isset($filters['name']) && !empty($filters['name']))
            $data->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%" . $filters['name'] . "%");

        if (isset($filters['is_active']) && !empty($filters['is_active']))
            $data->where('is_active', $filters['is_active']);

        if (isset($filters['email']) && !empty($filters['email']))
            $data->where('email', $filters['email']);

        if ($limit > 0) {
            return $data->limit($limit)->get();
        }

        return $data->paginate($pagination);
    }
}
