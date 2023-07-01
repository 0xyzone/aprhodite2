<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * Get the user associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('id','like', $term)->orWhere('phone','like', $term)->orWhere('alt-phone','like', $term);
        });
    }

    /**
     * Get all of the getItems for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getItems(): HasMany
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
}
