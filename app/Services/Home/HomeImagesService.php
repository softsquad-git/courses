<?php

namespace App\Services\Home;

use App\Models\Home\HomeImages;
use App\Services\Service;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use \Exception;
use JetBrains\PhpStorm\Pure;

class HomeImagesService extends Service
{
    /**
     * @param HomeImages $model
     */
    #[Pure] public function __construct(HomeImages $model)
    {
        parent::__construct($model);
    }

    use UploadFileTrait;

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function save(array $data): Model
    {
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = $this->uploadSingleFile($data['image'], HomeImages::$fileDir);
        }

        return parent::save($data);
    }
}
