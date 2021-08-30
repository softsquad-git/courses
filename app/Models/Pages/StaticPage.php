<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'static_page';

    /**
     * @var array|string[] $names
     */
    public static array $names = [
        'price_plan',
        'technical_require',
        'technical_problem',
        'intro_course'
    ];

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'content'
    ];
}
