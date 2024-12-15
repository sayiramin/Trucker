<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pickup_address',
        'delivery_address',
        'pickup_time',
        'delivery_time',
        'weight',
        'size',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
