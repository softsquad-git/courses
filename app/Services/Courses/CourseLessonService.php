<?php

namespace App\Services\Courses;

use App\Models\Courses\Lesson;
use App\Models\Lessons\EndLessonPage;
use App\Services\Service;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\Pure;
use \Exception;

class CourseLessonService extends Service
{
    use UploadFileTrait;

    /**
     * @param Lesson $model
     * @param CourseLessonEndPageService $courseLessonEndPageService
     */
    #[Pure] public function __construct(Lesson $model, private CourseLessonEndPageService $courseLessonEndPageService)
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
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = $this->uploadSingleFile($data['image'], Lesson::$fileDir);
        }

        if (isset($data['file_audio']) && !empty($data['file_audio'])) {
            $data['file_audio'] = $this->uploadSingleFile($data['file_audio'], Lesson::$fileDirAudio);
        }

        if (!isset($data['is_premium'])) {
            $data['is_premium'] = 0;
        }

        $this->courseLessonEndPageService->save($data['endLesson'], $model->endLesson);

        return parent::update($data, $model);
    }

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function save(array $data): Model
    {
        DB::beginTransaction();
        try {
            if (isset($data['image']) && !empty($data['image'])) {
                $data['image'] = $this->uploadSingleFile($data['image'], Lesson::$fileDir);
            }

            if (isset($data['file_audio']) && !empty($data['file_audio'])) {
                $data['file_audio'] = $this->uploadSingleFile($data['file_audio'], Lesson::$fileDirAudio);
            }

            /**
             * @var Lesson $item
             */
            $item = parent::save($data);

            $data['endLesson']['lesson_id'] = $item->id;
            $this->courseLessonEndPageService->save($data['endLesson']);

            DB::commit();
            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
