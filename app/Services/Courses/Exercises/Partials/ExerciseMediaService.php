<?php

namespace App\Services\Courses\Exercises\Partials;

use App\Models\Courses\Exercises\Exercise;
use App\Traits\UploadFileTrait;
use Illuminate\Http\UploadedFile;
use \Exception;

abstract class ExerciseMediaService
{
    use UploadFileTrait;

    protected function uploadImage(UploadedFile $file): ?string
    {
        return $this->uploadSingleFile($file, Exercise::$fileImageDir);
    }

    public function uploadSoundFile(UploadedFile $file): ?string
    {
        return $this->uploadSingleFile($file, Exercise::$fileSoundDir);
    }
}
