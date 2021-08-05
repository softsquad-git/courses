<?php

namespace App\Services\Home;

use App\Models\Home\HomeInfoImages;
use App\Traits\UploadFileTrait;
use \Exception;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class HomeInformationImageService extends Service
{
    use UploadFileTrait;

    /**
     * @param HomeInfoImages $model
     */
    #[Pure] public function __construct(HomeInfoImages $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function save(array $data): Model
    {
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = $this->uploadSingleFile($data['image'], HomeInfoImages::$fileIconDir);
        }
        return parent::save($data);
    }

    /**
     * @param array $data
     * @param Model $model
     * @return Model
     * @throws Exception
     */
    public function update(array $data, Model $model): Model
    {
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = $this->uploadSingleFile($data['image'], HomeInfoImages::$fileIconDir);
        }
        return parent::update($data, $model);
    }
}
