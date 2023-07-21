<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_id',
        'source_name',
        'is_cache',
        'amount',
        'inputs',
    ];

    protected $casts = [
        'inputs' => 'array',
        'is_cache' => 'boolean',
    ];
}
