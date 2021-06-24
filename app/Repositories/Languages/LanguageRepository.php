<?php

namespace App\Repositories\Languages;

use App\Models\Languages\Language;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class LanguageRepository extends Repository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->model = $language;
    }
}
