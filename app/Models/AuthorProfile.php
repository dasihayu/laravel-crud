<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'age',
        'office',
        'bio'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
