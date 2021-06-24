<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

abstract class Service
{
    /**
     * @var Model $model
     */
    private Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function save(array $data): Model
    {
        return $this->model::create($data);
    }

    /**
     * @param array $data
     * @param Model $model
     * @return Model
     */
    public function update(array $data, Model $model): Model
    {
        $model->update($data);

        return $model;
    }

    /**
     * @param Model $model
     * @return bool|null
     */
    public function remove(Model $model): ?bool
    {
        return $model->delete();
    }
}
