<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models\Settings
 * @property string name
 * @property string type
 * @property string value
 * @property string value_item
 * @property string name_trans
 * @property string type_trans
 * @method static insert(array[] $data)
 */
class SettingApp extends Model
{
    use HasFactory;

    /**
     * @var array|string[] $typeValue
     */
    public static array $typeValue = [
        'file' => 'file',
        'txt' => 'txt'
    ];

    /**
     * @var string $fileDir
     */
    public static string $fileDir = 'assets/media/settings/';

    /**
     * @var string $table
     */
    protected $table = 'settings_app';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'type',
        'value'
    ];

    /**
     * @var string[] $appends
     */
    protected $appends = [
        'value_item',
        'name_trans',
        'type_trans'
    ];

    /**
     * @return string
     */
    public function getValueItemAttribute(): string
    {
        if ($this->type == self::$typeValue['file']) {
            return asset(self::$fileDir.$this->value);
        }

        return $this->value;
    }

    /**
     * @return string
     */
    public function getNameTransAttribute(): string
    {
        return __('trans.admin.settings.'.$this->name);
    }

    /**
     * @return string
     */
    public function getTypeTransAttribute(): string
    {
        return __('trans.admin.settings.types.'.$this->type);
    }
}
