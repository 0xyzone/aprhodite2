<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('name','like', $term);
        });
    }
}
