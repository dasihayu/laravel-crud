<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'serial_number',
        'author_id',
        'published_at',
    ];

    public function author()
    {
        
        return $this->belongsTo(Author::class);
    }
}
