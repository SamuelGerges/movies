<?php

namespace App\Console\Commands;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get all movies from TMDB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getPopularMovies();
        $this->getNowPlayingMovies();
        $this->getUpcomingMovies();
    }

    private function getPopularMovies()
    {
        for ($i = 1; $i <= config('services.tmdb.max_pages'); $i++) {
            $response = Http::get(config('services.tmdb.base_url') .
                'movie/popular?api_key=' . config('services.tmdb.api_key') .
                '&page=' . $i);
            foreach ($response->json()['results'] as $result) {
                $movie = Movie::updateOrCreate(
                    [
                        'e_id' => $result['id'],
                        'title' => $result['title'],
                    ],
                    [
                        'description' => $result['overview'],
                        'poster' => $result['poster_path'],
                        'banner' => $result['backdrop_path'],
                        'release_date' => $result['release_date'],
                        'vote' => $result['vote_average'],
                        'vote_count' => $result['vote_count'],

                    ]);  // end of updateOrCreate
                $this->attachGenres($result, $movie);
                $this->attachActors($movie);
                $this->getImages($movie);

            }
        }

    }// end of getPopularMovies

    private function getNowPlayingMovies()
    {
        for ($i = 1; $i <= config('services.tmdb.max_pages'); $i++) {
            $response = Http::get(config('services.tmdb.base_url') .
                'movie/now_playing?api_key=' . config('services.tmdb.api_key') .
                '&page=' . $i);
            foreach ($response->json()['results'] as $result) {
                $movie = Movie::updateOrCreate(
                    [
                        'e_id' => $result['id'],
                        'title' => $result['title'],
                    ],
                    [
                        'description' => $result['overview'],
                        'poster' => $result['poster_path'],
                        'banner' => $result['backdrop_path'],
                        'type' => 'now_playing',
                        'release_date' => $result['release_date'],
                        'vote' => $result['vote_average'],
                        'vote_count' => $result['vote_count'],

                    ]);  // end of updateOrCreate
                $this->attachGenres($result, $movie);
                $this->attachActors($movie);
                $this->getImages($movie);

            }
        }

    }// end of getNowPlayingMovies
    private function getUpcomingMovies()
    {
        for ($i = 1; $i <= config('services.tmdb.max_pages'); $i++) {
            $response = Http::get(config('services.tmdb.base_url') .
                'movie/upcoming?api_key=' . config('services.tmdb.api_key') .
                '&page=' . $i);
            foreach ($response->json()['results'] as $result) {
                $movie = Movie::updateOrCreate(
                    [
                        'e_id' => $result['id'],
                        'title' => $result['title'],
                    ],
                    [
                        'description' => $result['overview'],
                        'poster' => $result['poster_path'],
                        'banner' => $result['backdrop_path'],
                        'type' => 'upcoming',
                        'release_date' => $result['release_date'],
                        'vote' => $result['vote_average'],
                        'vote_count' => $result['vote_count'],

                    ]);  // end of updateOrCreate
                $this->attachGenres($result, $movie);
                $this->attachActors($movie);
                $this->getImages($movie);

            }
        }

    }// end of getUpcomingMovies


    private function attachGenres($result, Movie $movie)
    {
        foreach ($result['genre_ids'] as $genre_id) {
            $genre = Genre::where('e_id', $genre_id)->first();
            $movie->genres()->syncWithoutDetaching($genre->id);
        }//end foreach of genre
    } // end od attachgenre

    private function attachActors(Movie $movie)
    {
        $response = Http::get(config('services.tmdb.base_url') .
            'movie/' . $movie->e_id . '/credits?api_key=' .
            config('services.tmdb.api_key'));

        foreach ($response->json()['cast'] as $index => $cast) {
            if ($cast['known_for_department'] !== 'Acting') continue;
            if ($index == 8) break;

            $actor = Actor::where('e_id', $cast['id'])->first();
            if (!$actor) {
                $actor = Actor::create([
                    'e_id' => $cast['id'],
                    'name' => $cast['name'],
                    'image' => $cast['profile_path'],
                ]);
            }//end of if

            $movie->actors()->syncWithoutDetaching($actor);
        } // end foreach
    } // end od attchActors`

    private function getImages(Movie $movie)
    {
        $response = Http::get(config('services.tmdb.base_url') .
            'movie/' . $movie->e_id . '/images?api_key=' .
            config('services.tmdb.api_key'));
        $movie->images()->delete();
        foreach ($response->json()['backdrops'] as $index => $image) {
            if($index == 15) break;
            $movie->images()->create([
                'image' => $image['file_path'],
            ]);
        } // end foreach
    }

}
