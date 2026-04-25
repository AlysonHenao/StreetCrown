{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled mb-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('profile.name') }}</label>
                        <input id="name" name="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $viewData['user']->getName()) }}" required />
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('profile.email') }}</label>
                        <input type="text" class="form-control"
                               value="{{ $viewData['user']->getEmail() }}" disabled />
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('profile.phone') }}</label>
                        <input id="phone" name="phone" type="tel"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $viewData['user']->getPhone()) }}" required />
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('profile.address') }}</label>
                        <input id="address" name="address" type="text"
                               class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $viewData['user']->getAddress()) }}" required />
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">{{ __('profile.city') }}</label>
                        <input id="city" name="city" type="text"
                               class="form-control @error('city') is-invalid @enderror"
                               value="{{ old('city', $viewData['user']->getCity()) }}" required />
                        @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="postal_code" class="form-label">{{ __('profile.postal_code') }}</label>
                        <input id="postal_code" name="postal_code" type="text"
                               class="form-control @error('postal_code') is-invalid @enderror"
                               value="{{ old('postal_code', $viewData['user']->getPostalCode()) }}" required />
                        @error('postal_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('profile.save_button') }}</button>
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">{{ __('profile.cancel_button') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection