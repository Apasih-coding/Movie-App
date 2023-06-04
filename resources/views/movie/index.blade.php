@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-16">
    <div class="popular-movies">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg text-semibold">Popular Movies</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach($popularMovies as $movie)
            <x-movie-card-component :movie="$movie" />
            @endforeach
        </div>
    </div> <!--end popular movie -->

    <div class="now-playing-movies py-24">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg text-semibold">Now Playing</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach($nowPlayingMovies as $movie)
            <x-movie-card-component :movie="$movie" />
            @endforeach
        </div>
    </div>
</div>
@endsection