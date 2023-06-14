<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullName',
        'phone',
        'alt-phone',
        'address',
        'email',
        'location',
        'user_id',
        'discount',
        'advance',
        'total_price',
        'gateway',
        'payment_status',
        'delivery_status',
        'rider_id',
        'order_status',
        'note',
    ];
}
