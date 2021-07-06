<?php

namespace App\Services\Courses;

use App\Models\Courses\Lesson;
use App\Traits\UploadFileTrait;
use Illuminate\Http\UploadedFile;
use \Exception;

class CourseLessonImageService
{
    use UploadFileTrait;

    /**
     * @param UploadedFile|array $files
     * @return array
     * @throws Exception
     */
    public function upload(array|UploadedFile $files): array
    {
        return $this->uploadMultipleFile($files, Lesson::$fileDir);
    }

    /**
     * @param array $filenames
     * @return bool
     * @throws Exception
     */
    public function remove(array $filenames): bool
    {
        return $this->removeMultipleFile($filenames, Lesson::$fileDir);
    }
}
