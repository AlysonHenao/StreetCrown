{{-- Author: Emmanuel Cortés --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>{{ $viewData['title'] }}</h1>

    @foreach($viewData['stores'] as $store)
    <div class="mb-5">
        <h2>{{ $store['name'] }}</h2>
        <p>{{ $store['address'] }}</p>

        <iframe
            width="100%"
            height="350"
            style="border:0"
            loading="lazy"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="{{ $store['map_url'] }}">
        </iframe>
    </div>
    @endforeach
</div>
@endsection