<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'birthday'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'author_book');
    }

    public function ratings()
    {
        return $this->hasMany(AuthorRating::class);
    }
}
