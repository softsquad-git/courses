<?php

namespace App\Services\Users;

use App\Models\Users\UserRerun;
use App\Services\Service;
use JetBrains\PhpStorm\Pure;

class UserRerunsService extends Service
{
    /**
     * @param UserRerun $model
     */
    #[Pure] public function __construct(UserRerun $model)
    {
        parent::__construct($model);
    }
}
