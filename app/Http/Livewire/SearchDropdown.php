<?php

namespace App\Http\Livewire;

use App\ViewModels\SearchViewModel;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResult = [];
        if (strlen($this->search) >= 2) {
            $searchResult = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/multi?query=' . $this->search)->json()['results'];
        }

        $viewModel = new SearchViewModel($searchResult);
        // dump($searchResult);
        return view('livewire.search-dropdown', $viewModel);
    }
}
