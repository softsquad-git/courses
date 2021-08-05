<?php

namespace App\Services\Courses\Exercises;

use App\Models\Courses\Exercises\ExerciseSpeechBubble;
use App\Services\Service;
use JetBrains\PhpStorm\Pure;

class ExerciseSpeechBubbleService extends Service
{
    /**
     * @param ExerciseSpeechBubble $model
     */
    #[Pure] public function __construct(ExerciseSpeechBubble $model)
    {
        parent::__construct($model);
    }
}
