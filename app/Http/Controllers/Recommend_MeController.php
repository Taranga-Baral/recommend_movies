<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Recommend_MeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Step 1: Fetch all of current user's all_time_best_movies
        $userId = Auth::id(); // Get current authenticated user's ID
        $userAllTimeBestMovies = Movie::where('user_id', $userId)
            ->where('type', 'all_time_best_movies')
            ->get();

        if ($userAllTimeBestMovies->isEmpty()) {
            return redirect()->back()->with('error', 'No all_time_best_movies found for current user.');
        }

        // Step 2: Fetch user_ids where all_time_best_movies db_movie_id matches, excluding current user's ID
        $dbMovieIds = $userAllTimeBestMovies->pluck('db_movie_id')->toArray();

        $matchingUserIds = Movie::whereIn('db_movie_id', $dbMovieIds)
            ->where('user_id', '!=', $userId) // Exclude current user's ID
            ->where('type', 'all_time_best_movies')
            ->pluck('user_id')
            ->toArray();

        // Step 3: Fetch recommended_movies for all matching user_ids, excluding current user's ID
        $recommendedMovies = Movie::whereIn('user_id', $matchingUserIds)
            ->where('type', 'recommended_movies')
            ->orderByDesc('created_at')
            ->get();

        // Step 4: Pass data to view
        return view('Recommend_Me.index', compact('recommendedMovies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
