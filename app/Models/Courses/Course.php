<?php

namespace App\Models\Courses;

use App\Models\Languages\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @package App\Models\Courses
 * @property string name
 * @property int level_id
 * @property int language_id
 * @property bool is_active
 */
class Course extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'courses';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'level_id',
        'language_id',
        'is_active'
    ];

    /**
     * @return BelongsTo
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class)->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class)->withDefault();
    }
}
