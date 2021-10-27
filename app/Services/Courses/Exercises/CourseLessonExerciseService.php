<?php

namespace App\Services\Courses\Exercises;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Exercises\ExercisePairs;
use App\Repositories\Courses\CourseLessonExerciseRepository;
use App\Services\Courses\Exercises\Partials\ExerciseDataFieldsService;
use App\Services\Courses\Exercises\Partials\ExerciseDialogueService;
use App\Services\Courses\Exercises\Partials\ExerciseQuestionAnswersService;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\DB;
use Exception;

class CourseLessonExerciseService
{
    use UploadFileTrait;

    public function __construct(
        private ExerciseDataFieldsService $exerciseDataFieldsService,
        private ExerciseQuestionAnswersService $exerciseQuestionAnswersService,
        private CourseLessonExerciseRepository $courseLessonExerciseRepository,
    )
    {
    }

    /**
     * @param array $data
     * @return Exercise
     * @throws Exception
     */
    public function save(array $data): Exercise
    {
        DB::beginTransaction();
        try {
            $data['position'] = $this->courseLessonExerciseRepository->getMaxPosition($data['lesson_id']) + 1;
            if (isset($data['success_answer_file']) && !empty($data['success_answer_file'])) {
                $data['success_answer_file'] = $this->uploadSingleFile($data['success_answer_file'], Exercise::$fileSoundDir);
            }
            $exercise = Exercise::create($data);

            if ($exercise->type == Exercise::$types['MATCH_WORDS_PAIRS']) {
                foreach ($data['words'] as $word) {
                    ExercisePairs::create([
                        'exercise_id' => $exercise->id,
                        'txt' => $word['txt'],
                        'txt_trans' => $word['txt_trans']
                    ]);
                }

                DB::commit();
                return $exercise;
            }

            $fields = $this->exerciseDataFieldsService->save(
                $data,
                $exercise
            );

            if ($exercise->type == Exercise::$types['DIALOGUE']) {
                ExerciseDialogueService::save(json_decode($data['conversations'], true), $fields);
            }

            if (
                $exercise->type == Exercise::$types['LISTEN_ANSWER_QUESTION']
                ||
                $exercise->type == Exercise::$types['LISTEN_CHOOSE_ANSWER']
                ||
                $exercise->type == Exercise::$types['IMAGE_SELECT_ANSWER']
                ||
                $exercise->type == Exercise::$types['INDICATE_CORRECT_ANSWERS']
                ||
                $exercise->type == Exercise::$types['QUESTION_TRANS']
                ||
                $exercise->type == Exercise::$types['COMPLETE_SENTENCE']
            ) {
                if (is_string($data['answers'])) {
                    $data['answers'] = json_decode($data['answers'], true);
                }
                $this->exerciseQuestionAnswersService->save($data['answers'], $fields);
            }

            DB::commit();

            return $exercise;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    /**
     * @param array $data
     * @param Exercise $exercise
     * @return Exercise|void
     * @throws Exception
     */
    public function update(array $data, Exercise $exercise)
    {
        $successAnswerFile = $exercise->success_answer_file;
        if (isset($data['success_answer_file']) && !empty($data['success_answer_file'])) {
            $successAnswerFile = $this->uploadSingleFile($data['success_answer_file'], Exercise::$fileSoundDir);
        }

        $exercise->update([
            'speech_bubble_bottom' => $data['speech_bubble_bottom'],
            'header' => $data['header'],
            'success_answer_file' => $successAnswerFile
        ]);

        if ($exercise->type == Exercise::$types['IMAGE_TXT']) {
            $data = $this->updateFile($data);
            $exercise->template()->update([
                'image' => $data['image'] ?? $exercise->template->image,
                'sound_file' => $data['sound_file'] ?? $exercise->template->sound_file,
                'txt' => $data['txt'],
                'txt_trans' => $data['txt_trans']
            ]);

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['LISTEN_ANSWER_QUESTION']) {
            $data = $this->updateFile($data);

            $exercise->template()->update([
                'image' => $data['image'] ?? $exercise->template->image,
                'sound_file' => $data['sound_file'] ?? $exercise->template->sound_file,
                'txt' => $data['txt'],
                'txt_trans' => $data['txt_trans']
            ]);

            $exercise->template->answers()->delete();
            $exercise->template->answers()->insert(json_decode($data['answers'], true));

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['LISTEN_CHOOSE_ANSWER']) {
            $data = $this->updateFile($data);

            $exercise->template()->update([
                'sound_file' => $data['sound_file'] ?? $exercise->template->sound_file,
            ]);

            $exercise->template->answers()->delete();
            $exercise->template->answers()->insert(json_decode($data['answers'], true));

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['IMAGE_SELECT_ANSWER']) {
            $data = $this->updateFile($data);

            $exercise->template()->update([
                'image' => $data['image'] ?? $exercise->template->image,
                'sound_file' => $data['sound_file'] ?? $exercise->template->sound_file,
                'txt' => $data['txt'],
            ]);

            $exercise->template->answers()->delete();
            $exercise->template->answers()->insert(json_decode($data['answers'], true));

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['QUESTION_TRANS']) {
            $exercise->template()->update([
                'question' => $data['question'],
                'question_trans' => $data['question_trans']
            ]);

            $exercise->template->answers()->delete();
            $exercise->template->answers()->insert(json_decode($data['answers'], true));

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['INDICATE_CORRECT_ANSWERS']) {
            $exercise->template()->update([
                'txt' => $data['txt']
            ]);

            $exercise->template->answers()->delete();
            $exercise->template->answers()->insert(json_decode($data['answers'], true));

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['MATCH_WORDS_PAIRS']) {
            $words = [];
            foreach ($data['words'] as $word) {
                $words[] = [
                    'txt' => $word['txt'],
                    'txt_trans' => $word['txt_trans'],
                    'exercise_id' => $exercise->id
                ];
            }

            $exercise->template()->delete();
            $exercise->template()->insert($words);

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['ANSWER_QUESTION_BOOL']) {
            $exercise->template()->update([
                'question' => $data['question'],
                'is_true' => $data['is_true']
            ]);

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['TIP']) {
            $exercise->template()->update([
                'content' => $data['content']
            ]);

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['EXAMPLE_SENTENCES']) {
            $data = $this->updateFile($data);
            $exercise->template()->update([
                'txt' => $data['txt'],
                'txt_trans' => $data['txt_trans'],
                'sentence' => $data['sentence'],
                'sentence_trans' => $data['sentence_trans']
            ]);

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['DIALOGUE']) {
            $imageOne = $exercise->template->interlocutor_one_image;
            $imageTwo = $exercise->template->interlocutor_two_image;
            $soundFile = $exercise->template->sound_file;
            if (isset($data['interlocutor_one_image']) && !empty($data['interlocutor_one_image'])) {
                $imageOne = $this->uploadSingleFile($data['interlocutor_one_image'], Exercise::$fileImageDir);
            }
            if (isset($data['interlocutor_two_image']) && !empty($data['interlocutor_two_image'])) {
                $imageTwo = $this->uploadSingleFile($data['interlocutor_two_image'], Exercise::$fileImageDir);
            }
            if (isset($data['sound_file']) && !empty($data['sound_file'])) {
                $soundFile = $this->uploadSingleFile($data['sound_file'], Exercise::$fileSoundDir);
            }
            $exercise->template()->update([
                'interlocutor_one_image' => $imageOne,
                'interlocutor_two_image' => $imageTwo,
                'sound_file' => $soundFile
            ]);

            $conversations = json_decode($data['conversations'], true);
            $_conversation = [];
            foreach ($conversations as $conversation) {
                $_conversation[] = [
                    'txt' => $conversation['txt'],
                    'txt_trans' => $conversation['txt_trans'],
                    'type' => $conversation['type'],
                    'dialogue_id' => $exercise->template->id
                ];
            }

            $exercise->template->conversations()->delete();
            $exercise->template->conversations()->insert($_conversation);

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['FLASHCARD']) {
            $data = $this->updateFile($data);
            $exercise->template()->update([
                'txt' => $data['txt'],
                'txt_trans' => $data['txt_trans'],
                'image' => $data['image'] ?? $exercise->template->image,
                'sound_file' => $data['sound_file'] ?? $exercise->template->sound_file,
            ]);

            return $exercise;
        }

        if ($exercise->type == Exercise::$types['COMPLETE_SENTENCE']) {
            $exercise->template()->update([
                'sentence' => $data['sentence'],
                'sentence_trans' => $data['sentence_trans']
            ]);

            $exercise->template->answers()->delete();
            $exercise->template->answers()->insert(json_decode($data['answers'], true));

            return $exercise;
        }

    }

    private function updateFile(array $data) {
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = $this->uploadSingleFile($data['image'], Exercise::$fileImageDir);
        }
        if (isset($data['sound_file']) && !empty($data['sound_file'])) {
            $data['sound_file'] = $this->uploadSingleFile($data['sound_file'], Exercise::$fileSoundDir);
        }

        return $data;
    }

    /**
     * @param Exercise $exercise
     * @return bool|null
     */
    public function remove(Exercise $exercise): ?bool
    {
        return $exercise->delete();
    }
}
