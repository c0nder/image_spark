<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'cover',
        'description',
        'year'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }

    public function ratings()
    {
        return $this->hasMany(BookRating::class);
    }
}
