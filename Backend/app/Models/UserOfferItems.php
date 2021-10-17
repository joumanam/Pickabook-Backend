<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOfferItems extends Model
{
    use HasFactory;

    protected $table = 'offer_items';
    protected $fillable = [
        'offer_id',
        'book_id',
    ];


}
