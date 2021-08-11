<?php

namespace App\Models\Courses\Exercises\Dialogue;

use App\Models\Courses\Exercises\Exercise;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Models\Courses\Exercises\Dialogue
 * @property int exercise_id
 * @property string interlocutor_one_image
 * @property string interlocutor_two_image
 * @property string sound_file
 * @property Exercise exercise
 */
class Dialogue extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'dialogue';

    /**
     * @var array|string[] $types
     */
    public static array $types = [
        'interlocutor_one' => 'interlocutor_one',
        'interlocutor_two' => 'interlocutor_two'
    ];

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'exercise_id',
        'interlocutor_one_image',
        'interlocutor_two_image',
        'sound_file'
    ];

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class)->withDefault();
    }

    /**
     * @return HasMany
     */
    public function conversations(): HasMany
    {
        return $this->hasMany(DialogueConversation::class, 'dialogue_id');
    }

    /**
     * @return string|null
     */
    public function getSoundFile(): ?string
    {
        if ($this->sound_file) {
            return asset(Exercise::$fileSoundDir . $this->sound_file);
        }

        return null;
    }

    /**
     * @return string
     */
    public function getOneImage(): string
    {
        return asset(Exercise::$fileImageDir.$this->interlocutor_one_image);
    }

    /**
     * @return string
     */
    public function getTwoImage(): string
    {
        return asset(Exercise::$fileImageDir.$this->interlocutor_two_image);
    }
}
