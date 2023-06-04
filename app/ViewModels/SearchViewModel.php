<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class SearchViewModel extends ViewModel
{
    public $searchResult;

    public function __construct($searchResult)
    {
        $this->searchResult = $searchResult;
    }

    public function searchResult()
    {
        return collect($this->searchResult)->map(function ($query) {
            if (isset($query['poster_path'])) {
                $picture = 'https://image.tmdb.org/t/p/w92/' . $query['poster_path'];
            } elseif (isset($query['profile_path'])) {
                $picture = 'https://image.tmdb.org/t/p/w92/' . $query['profile_path'];
            } else {
                $picture = 'https://via.placeholder.com/300x450';
            }

            if (isset($query['title'])) {
                $title = $query['title'];
            } elseif (isset($query['name'])) {
                $title = $query['name'];
            } else {
                $title = 'Untitled';
            }

            if ($query['media_type'] === 'movie') {
                $linkToPage = route('movies.show', $query['id']);
            } elseif ($query['media_type'] === 'tv') {
                $linkToPage = route('tv.show', $query['id']);
            } else {
                $linkToPage = route('actors.show', $query['id']);
            }

            return collect($query)->merge([
                'picture' => $picture,
                'title' => $title,
                'linkToPage' => $linkToPage,
            ]);
        })->sortByDesc('popularity')->take(9);
    }
}
