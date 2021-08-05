<?php

namespace App\Models\Users;

use App\Models\Courses\Exercises\Exercise;
use App\Models\Courses\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $data)
 * @method static where(array $array)
 */
class UserLessonExerciseProgress extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'user_lesson_exercise_progress';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'lesson_id',
        'exercise_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class)->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }
}
