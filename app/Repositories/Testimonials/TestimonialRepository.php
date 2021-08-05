<?php

namespace App\Repositories\Testimonials;

use App\Models\Testimonials\Testimonial;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class TestimonialRepository extends Repository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param Testimonial $level
     */
    public function __construct(Testimonial $level)
    {
        $this->model = $level;
    }
}
