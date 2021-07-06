<?php

namespace App\Models\Newsletter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'newsletter';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'email',
        'ip_address'
    ];
}
