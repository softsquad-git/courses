<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Home
 * @property string icon
 * @property string title
 * @property string content
 */
class HomeInfo extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'home_info_course';

    /**
     * @var string $fileIconDir
     */
    public static string $fileIconDir = 'assets/data/home/images/';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'icon',
        'title',
        'content'
    ];

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return asset(self::$fileIconDir.$this->icon);
    }
}
