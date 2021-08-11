<?php

namespace App\Services\Courses\Exercises\Partials;

use App\Models\Courses\Exercises\Dialogue\DialogueConversation;
use Illuminate\Database\Eloquent\Model;

class ExerciseDialogueService
{
    /**
     * @param array $data
     * @param Model $model
     * @return bool
     */
    public static function save(array $data, Model $model): bool
    {
        $dataSave = [];

        foreach ($data as $datum) {
            $datum['dialogue_id'] = $model->id;
            $dataSave[] = $datum;
        }

        DialogueConversation::insert($dataSave);

        return true;
    }
}
