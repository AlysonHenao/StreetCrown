{{-- Author: Emmanuel Cortes --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $viewData['title'] }}</h1>

    @if($viewData['products']->count() > 0)
    <div class="row">
        @foreach($viewData['products'] as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img
                    src="{{ asset('storage/' . $product->getImage()) }}"
                    class="card-img-top"
                    alt="{{ $product->getName() }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->getName() }}</h5>
                    <p class="card-text"><strong>Brand:</strong> {{ $product->getBrand() }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $product->getPrice() }}</p>
                    <p class="card-text"><strong>Units sold:</strong> {{ $product->sold_quantity }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>No sales have been registered yet.</p>
    @endif
</div>
@endsection