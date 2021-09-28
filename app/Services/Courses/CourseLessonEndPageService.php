<?php

namespace App\Services\Courses;

use App\Models\Lessons\EndLessonPage;
use App\Traits\UploadFileTrait;
use Exception;
class CourseLessonEndPageService
{
    use UploadFileTrait;

    /**
     * @param array $data
     * @param EndLessonPage|null $endLessonPage
     * @return EndLessonPage
     * @throws Exception
     */
    public function save(array $data, EndLessonPage $endLessonPage = null): EndLessonPage
    {
        if ($endLessonPage) {
            if (isset($data['image']) && !empty($data['image'])) {
                $data['image'] = $this->uploadSingleFile($data['image'], EndLessonPage::$fileDir);

                $endLessonPage->update($data);

                return $endLessonPage;
            }
        }

        $data['image'] = $this->uploadSingleFile($data['image'], EndLessonPage::$fileDir);

        return EndLessonPage::create($data);
    }
}
