<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @package App\Models\Courses
 * @property string name
 * @property string|null description
 */
class Level extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'levels';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @return HasMany
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'level_id');
    }
}
