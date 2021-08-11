<?php

namespace App\Models\Courses\Exercises\Dialogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @package App\Models\Courses\Exercises\Dialogue
 * @property int dialogue_id
 * @property string type
 * @property string txt
 * @property string txt_trans
 * @property Dialogue dialogue
 * @method static insert(array $dataSave)
 */
class DialogueConversation extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'dialogue_conversation';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'dialogue_id',
        'type',
        'txt',
        'txt_trans'
    ];

    /**
     * @return BelongsTo
     */
    public function dialogue(): BelongsTo
    {
        return $this->belongsTo(Dialogue::class)->withDefault();
    }
}
