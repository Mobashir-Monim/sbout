<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePurchase extends Model
{
    use HasFactory;
    use Concerns\UsesUuid;

    protected $guarded = [];
    protected $casts = [
        'tx_data' => 'array',
        'user_data' => 'array',
        'validation_data' => 'array',
    ];

    public function setPriceAttribute($price)
    {
        $price = str_replace(',', '', $price);
        $this->attributes['price'] = round((float) ($price + 0), 2) * 100;
    }

    public function getPriceAttribute()
    {
        return number_format($this->attributes['price'] / 100, 2);
    }
}
