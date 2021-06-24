<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use \Exception;

trait UploadFileTrait
{
    /**
     * @param string $extension
     * @return string
     */
    protected function generateFilename(string $extension): string
    {
        return Str::random(32) . '.' . $extension;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string $dir
     * @return string
     * @throws Exception
     */
    public function uploadSingleFile(UploadedFile $uploadedFile, string $dir): string
    {
        try {
            $filename = $this->generateFilename($uploadedFile->extension());
            $uploadedFile->move($dir, $filename);

            return $filename;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param array|UploadedFile $uploadedFiles
     * @param string $dir
     * @return array
     * @throws Exception
     */
    public function uploadMultipleFile(array|UploadedFile $uploadedFiles, string $dir): array
    {
        try {
            $filenames = [];
            foreach ($uploadedFiles as $uploadedFile) {
                $filename = $this->generateFilename($uploadedFile->extension());
                $filenames[] = $filename;
                $uploadedFile->move($dir, $filename);
            }

            return $filenames;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param string $filename
     * @param string $dir
     * @return bool
     * @throws Exception
     */
    public function removeSingleFile(string $filename, string $dir): bool
    {
        try {
            $path = $dir . '/' . $filename;
            if (File::exists($path)) {
                File::delete($path);
            }

            return true;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param array $filenames
     * @param string $dir
     * @return bool
     * @throws Exception
     */
    public function removeMultipleFile(array $filenames, string $dir): bool
    {
        try {
            $paths = [];
            foreach ($filenames as $filename) {
                $path = $dir . '/' . $filename;
                if (File::exists($path)) {
                    $paths[] = $path;
                }
            }

            File::delete($paths);

            return true;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
