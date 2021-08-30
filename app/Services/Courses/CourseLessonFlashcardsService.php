<?php

namespace App\Services\Courses;

use App\Models\Courses\LessonFlashcard;
use App\Services\Service;
use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Model;
use \Exception;
use JetBrains\PhpStorm\Pure;

class CourseLessonFlashcardsService extends Service
{
    use UploadFileTrait;

    /**
     * @param LessonFlashcard $model
     */
    #[Pure] public function __construct(LessonFlashcard $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function save(array $data): Model
    {
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = $this->uploadSingleFile($data['image'], LessonFlashcard::$fileImageDir);
        }

        if (isset($data['sound_file']) && !empty($data['sound_file'])) {
            $data['sound_file'] = $this->uploadSingleFile($data['sound_file'], LessonFlashcard::$fileSoundDir);
        }

        return parent::save($data);
    }
}
