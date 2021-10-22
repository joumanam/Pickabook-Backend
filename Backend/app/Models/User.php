<?php

namespace App\Models;

use App\Models\UserHobby;
use App\Models\UserInterest;
use App\Models\UserNotification;
use App\Models\UserInfo;
use App\Models\UserPicture;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // public function images()
    // {
    //     return $this->hasOne(UserPicture::class)->where("is_profile_picture", 0);
    // }

    // public function profilePicture()
    // {
    //     return $this->hasOne(UserPicture::class, "user_id", "id")->where("is_profile_picture", 1);
    // }

    public function newNotifications()
    {
        return $this->hasMany(UserNotification::class)->where("is_read", 0);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function messagesSent()
    {
        return $this->hasMany(UserMessage::class, 'sender_id', 'id');
    }

    public function books()
    {
        return $this->hasMany(AddBook::class, 'user_id', 'id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(UserMessage::class, 'receiver_id', 'id');
    }

    public function location()
    {
        return $this->hasOne(UserInfo::class, "user_id", "id");
    }



    public function trades()
    {
        return $this->hasManyThrough(trades::class, AddBook::class);
    }

}
