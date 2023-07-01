<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'alt-phone',
    ];

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('id','like', $term)->orWhere('phone','like', $term);
        });
    }
}
