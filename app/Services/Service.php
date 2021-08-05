<?php

namespace App\Services;

use App\Models\Courses\Lesson;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use \Exception;

abstract class Service
{
    use UploadFileTrait;

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
     * @throws Exception
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
