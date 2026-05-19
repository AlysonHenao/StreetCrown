{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="auth-wrap">
    <div class="auth-card" style="max-width: 520px;">
        <div class="auth-logo">{{ __('layout.brand') }}</div>
        <div class="auth-subtitle">{{ __('auth.register_subtitle') }}</div>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 1.25rem;">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.register') }}" novalidate>
            @csrf

            <div style="margin-bottom: 1rem;">
                <label for="name" class="form-label">{{ __('auth.name') }}</label>
                <input id="name" name="name" type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="{{ __('auth.name_placeholder') }}"
                       autocomplete="name" autofocus required />
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="email" class="form-label">{{ __('auth.email') }}</label>
                <input id="email" name="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="{{ __('auth.email_placeholder') }}"
                       autocomplete="email" required />
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="password" class="form-label">{{ __('auth.password') }}</label>
                <input id="password" name="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="{{ __('auth.password_placeholder') }}"
                       autocomplete="new-password" required />
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label for="password_confirmation" class="form-label">{{ __('auth.password_confirm') }}</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       class="form-control"
                       placeholder="{{ __('auth.password_placeholder') }}"
                       autocomplete="new-password" required />
            </div>

            <hr class="auth-divider">

            <div style="margin-bottom: 1rem;">
                <label for="phone" class="form-label">{{ __('profile.phone') }}</label>
                <input id="phone" name="phone" type="tel"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone') }}" required />
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="address" class="form-label">{{ __('profile.address') }}</label>
                <input id="address" name="address" type="text"
                       class="form-control @error('address') is-invalid @enderror"
                       value="{{ old('address') }}" required />
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="city" class="form-label">{{ __('profile.city') }}</label>
                <input id="city" name="city" type="text"
                       class="form-control @error('city') is-invalid @enderror"
                       value="{{ old('city') }}" required />
                @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="postal_code" class="form-label">{{ __('profile.postal_code') }}</label>
                <input id="postal_code" name="postal_code" type="text"
                       class="form-control @error('postal_code') is-invalid @enderror"
                       value="{{ old('postal_code') }}" required />
                @error('postal_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
                {{ __('auth.register_button') }}
            </button>
        </form>

        <hr class="auth-divider">
        <p class="auth-footer-text">
            {{ __('auth.have_account') }}
            <a href="{{ route('login') }}" style="color: var(--c-accent);">{{ __('auth.login_link') }}</a>
        </p>
    </div>
</div>
@endsection