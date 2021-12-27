<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    use Concerns\UsesUuid;

    protected $guarded = [];
    protected $casts = [
        'variable' => 'array'
    ];
}
