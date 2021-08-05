<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Home
 * @property string image
 * @property string position
 * @property string title
 * @property string content
 * @property int order
 */
class HomeInfoImages extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'home_info_images';

    /**
     * @var array|string[] $positions
     */
    public static array $positions = [
        'right' => 'right',
        'left' => 'left'
    ];

    /**
     * @var string $fileIconDir
     */
    public static string $fileIconDir = 'assets/data/home/images/';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'image',
        'position',
        'title',
        'content',
        'order'
    ];

    /**
     * @return string
     */
    public function getImage(): string
    {
        return asset(self::$fileIconDir.$this->image);
    }
}
