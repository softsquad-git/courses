<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Home
 * @property string image
 * @property string position
 */
class HomeImages extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'home_images';

    /**
     * @var array|string[] $positions
     */
    public static array $positions = [
        'top' => 'top',
        'one' => 'one',
        'two' => 'two'
    ];

    /**
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'image',
        'position'
    ];

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/data/home/';

    /**
     * @return string
     */
    public function getImage(): string
    {
        return asset(self::$fileDir.$this->image);
    }
}
