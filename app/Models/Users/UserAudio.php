<?php

namespace App\Models\Users;

use App\Models\Courses\Lesson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int user_id
 * @property int lesson_id
 * @property string file
 * @property User user
 * @property Lesson lesson
 * @method static create(array $data)
 * @method static orderBy(string $string, string $string1)
 * @method static find(int $id)
 */
class UserAudio extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'user_audios';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'lesson_id',
        'file'
    ];

    /**
     * @return string|null
     */
    public function getFile(): ?string
    {
        if ($this->file) {
            return asset(Lesson::$fileDirAudio.$this->file);
        }

        return null;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class)
            ->withDefault();
    }
}
