<?php

namespace App\Services\Courses;

use App\Models\Courses\Lesson;
use App\Services\Service;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use \Exception;

class CourseLessonService extends Service
{
    use UploadFileTrait;

    /**
     * @param Lesson $model
     */
    #[Pure] public function __construct(Lesson $model)
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

        return parent::update($data, $model);
    }

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function save(array $data): Model
    {
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = $this->uploadSingleFile($data['image'], Lesson::$fileDir);
        }

        if (isset($data['file_audio']) && !empty($data['file_audio'])) {
            $data['file_audio'] = $this->uploadSingleFile($data['file_audio'], Lesson::$fileDirAudio);
        }

        return parent::save($data);
    }
}
