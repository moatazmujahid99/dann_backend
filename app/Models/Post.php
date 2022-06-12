<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Hypefactors\Laravel\Follow\Traits\CanFollow;
use Hypefactors\Laravel\Follow\Contracts\CanFollowContract;
use Hypefactors\Laravel\Follow\Traits\CanBeFollowed;
use Hypefactors\Laravel\Follow\Contracts\CanBeFollowedContract;

class Post extends Model implements CanFollowContract, CanBeFollowedContract
{
    use HasFactory;

    use CanFollow, CanBeFollowed;

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
