{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">{{ __('review.create_title') }}</h2>
            <p class="text-muted mb-4">{{ __('review.create_subtitle', ['product' => $viewData['product']->getName()]) }}</p>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ __('review.validation_errors') }}</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('review.store', $viewData['product']->getId()) }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">

                <div class="mb-3">
                    <label for="rating" class="form-label">{{ __('review.rating') }}</label>
                    <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                        <option value="">{{ __('review.select_rating') }}</option>
                        <option value="1" @selected(old('rating') == 1)>★ {{ __('review.rating_1') }}</option>
                        <option value="2" @selected(old('rating') == 2)>★★ {{ __('review.rating_2') }}</option>
                        <option value="3" @selected(old('rating') == 3)>★★★ {{ __('review.rating_3') }}</option>
                        <option value="4" @selected(old('rating') == 4)>★★★★ {{ __('review.rating_4') }}</option>
                        <option value="5" @selected(old('rating') == 5)>★★★★★ {{ __('review.rating_5') }}</option>
                    </select>
                    @error('rating')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">{{ __('review.comment') }} <span class="text-muted">({{ __('review.optional') }})</span></label>
                    <textarea
                        class="form-control @error('comment') is-invalid @enderror"
                        id="comment"
                        name="comment"
                        rows="5"
                        placeholder="{{ __('review.comment_placeholder') }}"
                        maxlength="1000"
                    >{{ old('comment') }}</textarea>
                    <small class="text-muted d-block mt-2">
                        {{ __('review.comment_help', ['min' => 10, 'max' => 1000]) }}
                    </small>
                    @error('comment')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark">
                        {{ __('review.submit') }}
                    </button>
                    <a href="{{ route('product.show', $viewData['product']->getId()) }}" class="btn btn-outline-secondary">
                        {{ __('review.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
