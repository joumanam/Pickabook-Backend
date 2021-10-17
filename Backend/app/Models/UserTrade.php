<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrade extends Model
{
    use HasFactory;

    protected $table = 'trades';
    protected $fillable = [
        'user_id',
        'book_id',
    ];

    // public function book()
    // {
    //     return $this->hasOne(UserOffer::class, 'book_id', 'id');
    // }

    public function offers()
    {
        return $this->hasMany(UserOffer::class, 'trade_id', 'id');
    }

}
