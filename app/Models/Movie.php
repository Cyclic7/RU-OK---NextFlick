<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'poster_url', 'release_year', 'average_rating'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
