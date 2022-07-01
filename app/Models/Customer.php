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

class Customer extends Authenticatable implements CanFollowContract, CanBeFollowedContract
{
    use HasApiTokens, HasFactory;

    use CanFollow, CanBeFollowed;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password', 'customer_img', 'bio', 'address', 'lat', 'lng'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->orderByDesc('updated_at');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
