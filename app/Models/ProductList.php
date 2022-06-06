<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;
    //protected $guarded = [];
    protected $fillable = [
        'title',
        'price',
        'special_price',
        'image',
        'category',
        'subcategory',
        'remark',
        'brand',
        'star',
        'product_code',

    ];

}
