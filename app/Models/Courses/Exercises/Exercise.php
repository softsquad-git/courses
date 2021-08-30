<?php

namespace App\Models\Courses\Exercises;

use App\Models\Courses\Exercises\Dialogue\Dialogue;
use App\Models\Courses\Lesson;
use App\Models\Exercises\ExerciseQuestionTrans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @package App\Models\Courses\Exercises
 * @property int id
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
        'IMAGE_TXT' => 1,                        // xx zdjęcie / tekst / tłumaczenie
        'LISTEN_ANSWER_QUESTION' => 2,           // xx
        'LISTEN_CHOOSE_ANSWER' => 3,             // xx
        'IMAGE_SELECT_ANSWER' => 4,              // xx
        'QUESTION_TRANS' => 5,                   // ?  Odpowiedz na pytanie (pytanie z tłumaczeniem)
        'INDICATE_CORRECT_ANSWERS' => 6,         // xx wskaż prawidłowe odpowiedzi (można kilka)
        'MATCH_WORDS_PAIRS' => 7,                // ?  połącz słowa w pary
        'ANSWER_QUESTION_BOOL' => 8,             // xx dotyczy ćwiczenia 10 w briefie
        'TIP' => 9,                              // xx wskazówka
        'EXAMPLE_SENTENCES' => 10,               // xx przykłady zdań
        'DIALOGUE' => 11,                        // xx dialog
        'FLASHCARD' => 12                        // xx fiszka
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

    /**
     * @return HasOne|null
     */
    public function template(): ?HasOne
    {
        $object = null;

        $object = match ((int)$this->type) {
            1 => ExerciseImageTxt::class,
            2 => ExerciseListenAnswerQuestion::class,
            3 => ExerciseListenChooseAnswer::class,
            4 => ExerciseImageAnswer::class,
            5 => ExerciseQuestionTrans::class,
            6 => ExerciseIndicateCorrectAnswer::class,
            8 => ExerciseQuestionTrueOrFalse::class,
            9 => ExerciseTip::class,
            10 => ExerciseExampleSentence::class,
            11 => Dialogue::class,
            12 => ExerciseFlashcard::class
        };

        return $this->hasOne($object, 'exercise_id')->withDefault();
    }

    /**
     * @return HasOne
     */
    public function speechBubbles(): HasOne
    {
        return $this->hasOne(ExerciseSpeechBubble::class, 'exercise_id');
    }
}
