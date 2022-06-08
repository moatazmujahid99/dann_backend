<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'post_img', 'seller_id', 'customer_id'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc('updated_at');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
