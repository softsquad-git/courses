<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Courses
 * @property string src
 * @method static insert(array $data)
 */
class LessonImage extends Model
{
    use HasFactory;

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/media/courses/lessons/';

    /**
     * @var string $table
     */
    protected $table = 'lesson_images';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'src'
    ];
}
