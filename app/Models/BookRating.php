<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRating extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'user_id', 'book_id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
