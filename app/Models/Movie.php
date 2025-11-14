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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->where('type', 'like')->count();
    }

    public function getDislikesCountAttribute()
    {
        return $this->likes()->where('type', 'dislike')->count();
    }
    

    public function getCommentsCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function getTomatometerAttribute()
    {
        $totalRatings = $this->ratings()->count();
        if ($totalRatings === 0) {
            return 0;
        }

        $positiveRatings = $this->ratings()->where('score', '>=', 6.0)->count();

        return min(100, round(($positiveRatings / $totalRatings) * 100));
    }

    public function getTomatometerStatusAttribute()
    {
        $score = $this->tomatometer;
        $totalRatings = $this->ratings()->count();

        if ($score >= 75 && $totalRatings >= 80) {
            return 'Certified Fresh';
        } elseif ($score >= 60) {
            return 'Fresh';
        } else {
            return 'Rotten';
        }
    }

    public function getTomatometerIconAttribute()
    {
        $status = $this->tomatometer_status;

        if ($status === 'Certified Fresh') {
            return '🏆'; // Badge of excellence
        } elseif ($status === 'Fresh') {
            return '🍅'; // Red tomato
        } else {
            return '💩'; // Green splat (using poop emoji as splat)
        }
    }
}
