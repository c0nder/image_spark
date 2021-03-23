<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorRating extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'user_id', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
