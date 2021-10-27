<?php

namespace App\Http\Resources\Courses;

use App\Models\Courses\Exercises\Exercise;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CourseLessonExercisesTemplateResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = parent::toArray($request);
        $data['header'] = $this->exercise?->header;

        if ($this->exercise?->success_answer_file) {
            $data['success_answer_file'] = $this->exercise?->getSuccessAnswerFile();
        }

        if ($this->image) {
            $data['image'] = $this->getImage();
        }

        if ($this->sound_file) {
            $data['sound_file'] = $this->getSoundFile();
        }

        if ($this->answers) {
            $data['answers'] = CourseExerciseAnswersResource::collection($this->answers);
        }

        if ($this->type == 7) {
            $data['words'] = CourseLessonExerciseMatchPairsResource::collection($this->template);
        }

        if ($this->exercise->type == Exercise::$types['IMAGE_TXT']) {
            $all = Exercise::where(['lesson_id' => $this->exercise?->lesson_id, 'type' => Exercise::$types['IMAGE_TXT']])->get()->sortBy('position');

            $ids = [];
            foreach ($all as $value) {
                $ids[] = $value->id;
            }

            $current = array_search($this->exercise?->id, $ids);

            $data['counts'] = [
                'all' => count($ids),
                'current' => $current ? $current + 1 : 1
            ];
        }

        return $data;
    }
}
