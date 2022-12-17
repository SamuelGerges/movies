<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActorResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::whenType(request()->type)
            ->with('genres')
            ->whenSearch(request()->search)
            ->paginate(10);

        $data['movies'] = MovieResource::collection($movies)->response()->getData(true);
        return response()->api($data);
    }


    public function toggleFavorite()
    {
        auth()->user()->favoriteMovies()->toggle([request()->movie_id]);

        return response()->api(null, 0, 'movie toggle successfully');
    }


    public function images(Movie $movie)
    {
        return response()->api(ImageResource::collection($movie->images));
    }

    public function actors(Movie $movie)
    {
        return response()->api(ActorResource::collection($movie->actors));

    }

    public function relatedMovies(Movie $movie)
    {
        $movies = Movie::whereHas('genres', function ($q) use ($movie) {
            $q->whereIn('name', $movie->genres()->pluck('name'));
        })->where('id', '<>', $movie->id)
            ->paginate(10);

        return response()->api(MovieResource::collection($movies));

    }
}
