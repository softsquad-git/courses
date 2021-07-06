<?php

namespace App\Models\Courses\Exercises;

use App\Models\Courses\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @package App\Models\Courses\Exercises
 * @property int lesson_id
 * @property int position
 * @property int type
 * @method static create(array $data)
 * @method static orderBy(string $column, string $value)
 */
class Exercise extends Model
{
    use HasFactory;

    /**
     * @var array|int[] $types
     */
    public static array $types = [
        'IMAGE_TXT' => 1,
        'LISTEN_ANSWER_QUESTION' => 2,
        'LISTEN_CHOOSE_ANSWER' => 3,
        'QUESTION_SELECT_ANSWER' => 4,
        'IMAGE_SELECT_ANSWER' => 5,
        'INDICATE_CORRECT_ANSWERS' => 6,
        'MATCH_WORDS_PAIRS' => 7,
        'ANSWER_QUESTION_BOOL' => 8,
        'TIP' => 9,
        'EXAMPLE_SENTENCES' => 10
    ];

    /**
     * @var string $fileImageDir
     */
    public static string $fileImageDir = 'assets/data/media/exercises/images/';

    /**
     * @var string $fileSoundDir
     */
    public static string $fileSoundDir = 'assets/data/media/exercises/sounds/';

    /**
     * @var string $table
     */
    protected $table = 'exercises';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'lesson_id',
        'position',
        'type'
    ];

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class)->withDefault();
    }
}
