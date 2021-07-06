<?php

namespace App\Services\Courses\Exercises\Partials;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Exercises\ExerciseExampleSentence;
use App\Models\Courses\Exercises\ExerciseImageAnswer;
use App\Models\Courses\Exercises\ExerciseImageTxt;
use App\Models\Courses\Exercises\ExerciseListenAnswerQuestion;
use App\Models\Courses\Exercises\ExerciseListenChooseAnswer;
use App\Models\Courses\Exercises\ExerciseQuestionAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\Pure;
use \Exception;

final class ExerciseDataFieldsService extends ExerciseMediaService
{
    /**
     * @param array $data
     * @param Exercise $exercise
     * @throws Exception
     * @return Model
     */
    public function save(array $data, Exercise $exercise): Model
    {
        $fields = $this->fieldsObject($exercise->type);

        if (!$fields) {
            throw new Exception('Nie udało się utworzyć obiektu dla tego rodzaju ćwiczeń!');
        }

        $data['exercise_id'] = $exercise->id;

        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }
        $data['image'] = '';

        if (isset($data['sound_file']) && !empty($data['sound_file'])) {
            $data['sound_file'] = $this->uploadSoundFile($data['sound_file']);
        }
        $data['sound_file'] = '';

        return $fields::create($data);
    }

    /**
     * @param int $type
     * @return Model|null
     */
    #[Pure] private function fieldsObject(int $type): ?Model
    {
        $model = null;

        $model = match ($type) {
            Exercise::$types['IMAGE_TXT'] => new ExerciseImageTxt(),
            Exercise::$types['LISTEN_ANSWER_QUESTION'] => new ExerciseListenAnswerQuestion(),
            Exercise::$types['LISTEN_CHOOSE_ANSWER'] => new ExerciseListenChooseAnswer(),
            Exercise::$types['QUESTION_SELECT_ANSWER'] => new ExerciseQuestionAnswer(),
            Exercise::$types['IMAGE_SELECT_ANSWER'] => new ExerciseImageAnswer(),
            Exercise::$types['EXAMPLE_SENTENCES'] => new ExerciseExampleSentence(),
            default => null,
        };

        return $model;
    }
}
