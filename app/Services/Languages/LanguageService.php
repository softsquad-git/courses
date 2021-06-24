<?php

namespace App\Services\Languages;

use App\Models\Languages\Language;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class LanguageService extends Service
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param Language $model
     */
    #[Pure] public function __construct(Language $model)
    {
        parent::__construct($model);
    }
}
