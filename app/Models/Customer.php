<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'customer_img', 'bio',
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
