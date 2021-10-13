<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'body',
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, "sender_id");
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, "receiver_id");
    }
}
