<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'size',
        'color',
        'main_category',
        'sub_category',
        'image',
        'price',
        'discount_price',
        'quantity',
    ];
    
    protected $table = 'products';
    use HasFactory;
}
