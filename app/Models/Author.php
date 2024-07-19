<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function profile()
    {
        return $this->hasOne(AuthorProfile::class);
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'author_hobby');
    }
}
