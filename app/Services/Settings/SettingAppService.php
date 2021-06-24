<?php

namespace App\Services\Settings;

use App\Models\Settings\SettingApp;
use App\Services\Service;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use \Exception;

class SettingAppService extends Service
{
    use UploadFileTrait;

    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param SettingApp $model
     */
    #[Pure] public function __construct(SettingApp $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @param Model $model
     * @return Model
     * @throws Exception
     */
    public function update(array $data, Model $model): Model
    {
        if ($data['type'] == SettingApp::$typeValue['file'] && !empty($data['value'])) {
            $data['value'] = $this->uploadSingleFile($data['value'], SettingApp::$fileDir);
        }

        return parent::update($data, $model);
    }
}
