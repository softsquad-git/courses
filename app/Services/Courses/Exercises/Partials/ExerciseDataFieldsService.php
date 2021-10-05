<?php

namespace App\Services\Courses\Exercises\Partials;

use App\Models\Courses\Exercises\Dialogue\Dialogue;
use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Exercises\ExerciseCompleteSentence;
use App\Models\Courses\Exercises\ExerciseExampleSentence;
use App\Models\Courses\Exercises\ExerciseFlashcard;
use App\Models\Courses\Exercises\ExerciseImageAnswer;
use App\Models\Courses\Exercises\ExerciseImageTxt;
use App\Models\Courses\Exercises\ExerciseIndicateCorrectAnswer;
use App\Models\Courses\Exercises\ExerciseListenAnswerQuestion;
use App\Models\Courses\Exercises\ExerciseListenChooseAnswer;
use App\Models\Courses\Exercises\ExercisePairs;
use App\Models\Courses\Exercises\ExerciseQuestionAnswer;
use App\Models\Courses\Exercises\ExerciseQuestionTrueOrFalse;
use App\Models\Courses\Exercises\ExerciseTip;
use App\Models\Exercises\ExerciseQuestionTrans;
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

        if (isset($data['sound_file']) && !empty($data['sound_file'])) {
            $data['sound_file'] = $this->uploadSoundFile($data['sound_file']);
        }

        if (isset($data['interlocutor_one_image']) && !empty($data['interlocutor_one_image'])) {
            $data['interlocutor_one_image'] = $this->uploadImage($data['interlocutor_one_image']);
        }

        if (isset($data['interlocutor_two_image']) && !empty($data['interlocutor_two_image'])) {
            $data['interlocutor_two_image'] = $this->uploadImage($data['interlocutor_two_image']);
        }

        if (!isset($data['is_true'])) {
            $data['is_true'] = 0;
        }

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
            Exercise::$types['IMAGE_TXT']                           => new ExerciseImageTxt(),
            Exercise::$types['LISTEN_ANSWER_QUESTION']              => new ExerciseListenAnswerQuestion(),
            Exercise::$types['LISTEN_CHOOSE_ANSWER']                => new ExerciseListenChooseAnswer(),
            Exercise::$types['QUESTION_TRANS']                      => new ExerciseQuestionTrans(),
            Exercise::$types['IMAGE_SELECT_ANSWER']                 => new ExerciseImageAnswer(),
            Exercise::$types['EXAMPLE_SENTENCES']                   => new ExerciseExampleSentence(),
            Exercise::$types['TIP']                                 => new ExerciseTip(),
            Exercise::$types['INDICATE_CORRECT_ANSWERS']            => new ExerciseIndicateCorrectAnswer(),
            Exercise::$types['ANSWER_QUESTION_BOOL']                => new ExerciseQuestionTrueOrFalse(),
            Exercise::$types['DIALOGUE']                            => new Dialogue(),
            Exercise::$types['FLASHCARD']                           => new ExerciseFlashcard(),
            Exercise::$types['COMPLETE_SENTENCE']                   => new ExerciseCompleteSentence(),
            Exercise::$types['MATCH_WORDS_PAIRS']                   => new ExercisePairs(),
            default                                                 => null
        };

        return $model;
    }
}
