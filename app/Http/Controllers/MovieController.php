<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     // Default API key and URL
     $apiKey = '9defc7592f3ff73c36e7293b238a2719';
$apiUrl = 'https://api.themoviedb.org/3/discover/movie';
$searchApiUrl = 'https://api.themoviedb.org/3/search/movie';

// Extract parameters from the request (you can define more parameters as needed)
$includeAdult = $request->input('include_adult');
$language = $request->input('language', 'en-US');
$sortBy = $request->input('sort_by', 'popularity.desc');
$genres = $request->input('genre', []); // Default to empty array if no genres are selected
$genreString = implode(',', $genres); // Convert array of genre IDs to comma-separated string
$query = $request->input('query');

// Determine which API endpoint to use based on the presence of a search query
$endpoint = $query ? $searchApiUrl : $apiUrl;

// Example query parameters
$queryParams = [
    'include_adult' => $includeAdult == 'true' ? true : false,
    'include_video' => false,
    'language' => $language,
    'page' => 1,
    'sort_by' => $sortBy,
    'without_genres' => '99,10755',
    'vote_count.gte' => 100,
    'api_key' => $apiKey,
];

// Add genre and query parameters only if they are provided
if (!empty($genreString)) {
    $queryParams['with_genres'] = $genreString;
}

if ($query) {
    $queryParams['query'] = $query;
}

// Make HTTP GET request to the API
$response = Http::withoutVerifying()->get($endpoint, $queryParams);

// Check if the request was successful
if ($response->successful()) {
    $moviesData = $response->json()['results'];

    // Return view with moviesData
    return view('movies-frontend/index', [
        'movies' => $moviesData,
        'includeAdult' => $includeAdult, // Pass parameters back to view for form prefilling
        'language' => $language,
        'sortBy' => $sortBy,
        'genres' => $genres,
        'query' => $query,
    ]);
} else {
    // Handle API request failure
    return response()->json(['error' => 'Failed to fetch data from API'], $response->status());
}

    }



    public function create()
    {
        //no create page since we are not using forms for creating movies data. we are just fetching from random movies api
        return 'hi';
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ensure user is authenticated
        if (Auth::check()) {
            $movie = new Movie();
            $movie->title = $request->title;
            $movie->db_movie_id = $request->db_movie_id;
            $movie->original_title = $request->original_title;
            $movie->overview = $request->overview;
            $movie->popularity = $request->popularity;
            $movie->poster_path = $request->poster_path;
            $movie->backdrop_path = $request->backdrop_path;
            $movie->release_date = $request->release_date;
            $movie->original_language = $request->original_language;
            $movie->adult = $request->adult;
            $movie->type = $request->type;

            // Associate the authenticated user's ID with the movie
            $movie->user_id = Auth::id();

            $movie->save();

            return redirect()->back();
        } else {
            // Handle case where user is not authenticated
            return redirect()->route('login'); // Redirect to login page, for example
        }


    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'hi';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // return 'hi';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
