<?php

namespace App\Models;

use App\Models\UserHobby;
use App\Models\UserInterest;
use App\Models\UserNotification;
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
        'gender',
        'interested_in',
        'dob',
        'height',
        'weight',
        'nationality',
        'city',
        'country',
        'bio',
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

    // public function previewImages()
    // {
    //     return $this->hasMany(UserPicture::class)->where("is_profile_picture", 0)->limit(2);
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

    // public function books()
    // {
    //     return $this->hasMany(AddBook::class, 'user_id', 'id');
    // }

    public function messagesReceived()
    {
        return $this->hasMany(UserMessage::class, 'receiver_id', 'id');
    }

    public function trades()
    {
        return $this->hasManyThrough(trades::class, AddBook::class);
    }

    // Both for getting user connections, Checks user1_id & user2_id :: use with(["connectionsOne","connectionsTwo"]);
    public function connections()
    {
        // check https://stackoverflow.com/questions/18520209/how-to-access-model-hasmany-relation-with-where-condition/18600698
        // check https://stackoverflow.com/questions/24184069/laravel-merge-relationships

        // Get connections if the logged in user id is in user1_id + get the connected to user data
        $connectionsTempOne = $this->connectionsOne->load("userTwo");
        // Get connections if the logged in user id is in user2_id + get the connected to user data
        $connectionsTempTwo = $this->connectionsTwo->load("userOne");

        return $connectionsTempOne->merge($connectionsTempTwo);
    }

    public function connectionsOne()
    {
        return $this->hasMany(UserConnection::class, "user1_id", "id")->where('response', 1);
    }
    public function connectionsTwo()
    {
        return $this->hasMany(UserConnection::class, "user2_id", "id")->where('response', 1);
    }

    public function blocked()
    {
        return $this->hasMany(UserBlock::class, "from_user_id", "id");
    }
}
