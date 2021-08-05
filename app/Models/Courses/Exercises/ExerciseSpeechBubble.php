<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExerciseSpeechBubble extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'speech_bubbles';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'position',
        'content'
    ];

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }
}
