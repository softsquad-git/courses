<?php

namespace App\Models\Courses\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @package App\Models\Courses\Exercises
 * @property int exercise_id
 * @property string image
 * @property string txt
 * @property string txt_trans
 * @property string sound_file
 * @method static create(array $data)
 */
class ExerciseImageTxt extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'exercise_image_txt';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'image',
        'txt',
        'txt_trans',
        'sound_file'
    ];

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }
}
