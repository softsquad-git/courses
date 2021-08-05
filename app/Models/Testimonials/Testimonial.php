<?php

namespace App\Models\Testimonials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'testimonials';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'content',
        'author'
    ];
}
