<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRerun extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'user_reruns';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'user_id',
        'txt',
        'txt_trans',
        'sound_file'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
