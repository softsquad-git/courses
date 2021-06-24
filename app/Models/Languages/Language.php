<?php

namespace App\Models\Languages;

use App\Models\Courses\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Models\Languages
 * @property string name
 */
class Language extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'languages';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'code'
    ];

    /**
     * @return HasMany
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'language_id');
    }
}
