<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'release_date', 'rating', 'ticket_price', 'photo'];

    public function Genres()
    {
        return $this->hasMany(Genre::class);
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }
}
