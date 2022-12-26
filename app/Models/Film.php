<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Film extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'release_date', 'rating', 'ticket_price', 'photo'];
}
