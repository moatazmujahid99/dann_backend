<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


use Hypefactors\Laravel\Follow\Traits\CanFollow;
use Hypefactors\Laravel\Follow\Contracts\CanFollowContract;
use Hypefactors\Laravel\Follow\Traits\CanBeFollowed;
use Hypefactors\Laravel\Follow\Contracts\CanBeFollowedContract;

class Seller extends Authenticatable implements CanFollowContract, CanBeFollowedContract
{
    use HasFactory, Notifiable, HasApiTokens;

    use CanFollow, CanBeFollowed;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password', 'seller_img', 'phone_number',
        'address', 'category_id', 'lat', 'lng'
    ];

    public function category()
    {
        return $this->belongsTo(SellerCategory::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderByDesc('updated_at');
    }
    public function productDetails()
    {
        return $this->hasMany(ProductDetails::class)->orderByDesc('updated_at');
    }

    public function productList()
    {
        return $this->hasMany(ProductList::class)->orderByDesc('updated_at');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
