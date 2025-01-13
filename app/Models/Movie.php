<?php

// Movie.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'db_movie_id',
        'original_title',
        'overview',
        'popularity',
        'poster_path',
        'backdrop_path',
        'release_date',
        'original_language',
        'type',
        'adult',
        'user_id', // Include user_id in fillable array if you want to mass assign it
    ];

    /**
     * Get the user that owns the movie.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all movies.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllMovies()
    {
        return Movie::all();
    }
}
