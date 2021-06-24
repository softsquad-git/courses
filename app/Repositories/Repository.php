<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use \Exception;

abstract class Repository
{
    /**
     * @var string $ordering
     */
    protected string $ordering = 'DESC';

    /**
     * @var int $pagination
     */
    protected int $pagination = 20;

    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param int $id
     * @return Model
     * @throws Exception
     */
    public function find(int $id): Model
    {
        $item = $this->model->find($id);
        if ($item) {
            return $item;
        }

        throw new Exception(__('exceptions.no_found'));
    }

    /**
     * @return Collection|array
     */
    public function findAll(): Collection|array
    {
        return $this->model::all();
    }

    /**
     * @param array $filters
     * @return Model|null
     */
    public function findOneBy(array $filters): ?Model
    {
        return $this->model->where($filters)->first();
    }
}
