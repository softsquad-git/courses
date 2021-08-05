<?php

namespace App\Services\Home;

use \Exception;
use App\Models\Home\HomeInfo;
use App\Services\Service;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class HomeInformationService extends Service
{
    use UploadFileTrait;

    /**
     * @param HomeInfo $model
     */
    #[Pure] public function __construct(HomeInfo $model)
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
        if (isset($data['icon']) && !empty($data['icon'])) {
            $data['icon'] = $this->uploadSingleFile($data['icon'], HomeInfo::$fileIconDir);
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
        if (isset($data['icon']) && !empty($data['icon'])) {
            $data['icon'] = $this->uploadSingleFile($data['icon'], HomeInfo::$fileIconDir);
        }
        return parent::update($data, $model);
    }
}
