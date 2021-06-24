<?php

namespace App\Repositories\Settings;

use App\Models\Settings\SettingApp;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class SettingAppRepository extends Repository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param SettingApp $model
     */
    public function __construct(SettingApp $model)
    {
        $this->model = $model;
    }
}
