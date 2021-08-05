<?php

namespace App\Services\Testimonials;

use App\Models\Testimonials\Testimonial;
use App\Services\Service;
use JetBrains\PhpStorm\Pure;

class TestimonialService extends Service
{
    /**
     * @param Testimonial $model
     */
    #[Pure] public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }
}
