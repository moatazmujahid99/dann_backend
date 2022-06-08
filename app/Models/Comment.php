<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment_text', 'seller_id', 'customer_id', 'post_id'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
