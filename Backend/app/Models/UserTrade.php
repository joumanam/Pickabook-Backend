<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
    ];

    public function book()
    {
        return $this->hasOne(AddBook::class, 'book_id', 'id');
    }

}
