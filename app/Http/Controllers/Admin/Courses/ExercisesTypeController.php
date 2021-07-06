<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\ApiController;
use App\Models\Courses\Exercises\Exercise;
use Illuminate\Http\JsonResponse;

class ExercisesTypeController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $types = Exercise::$types;

        $results = null;

        foreach ($types as $key => $type) {
            $results[] = [
                'id' => $type,
                'value' => __('types.'.$key)
            ];
        }

        return $this->successResponse('', [
            'types' => $results
        ]);
    }
}
