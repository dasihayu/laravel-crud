<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_hobby');
    }
}
