<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowsViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv()
    {
        return $this->formatTvShows($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTvShows($this->topRatedTv);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTvShows($tv)
    {
        return collect($tv)->map(function ($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500' . $tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'id', 'name', 'poster_path', 'vote_average', 'first_air_date', 'genres', 'genre_ids'
            ]);
        });
    }
}
