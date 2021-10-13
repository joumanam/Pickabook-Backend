<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConnection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user1_id',
        'user2_id',
    ];

    public function userOne()
    {
        return $this->belongsTo(User::class, "user1_id");
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, "user2_id");
    }

}
