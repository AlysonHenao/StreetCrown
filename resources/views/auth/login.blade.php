{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', __('auth.login_subtitle'))

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-5">

        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-3" aria-hidden="true">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 26L8 12L14 20L18 8L22 20L28 12L32 26H4Z" fill="currentColor"/>
                            <rect x="4" y="27" width="28" height="4" rx="2" fill="currentColor"/>
                        </svg>
                    </div>
                    <h2 class="h4 fw-bold mb-1">{{ __('auth.login_title') }}</h2>
                    <p class="text-muted mb-0">{{ __('auth.login_subtitle') }}</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">{{ __('auth.email') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                </svg>
                            </span>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="{{ __('auth.email_placeholder') }}"
                                autocomplete="email"
                                autofocus
                                required
                            />
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">{{ __('auth.password') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                </svg>
                            </span>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{ __('auth.password_placeholder') }}"
                                autocomplete="current-password"
                                required
                            />
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="remember"
                            name="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        />
                        <label class="form-check-label" for="remember">{{ __('auth.remember_me') }}</label>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        {{ __('auth.login_button') }}
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" class="ms-2" aria-hidden="true">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </button>
                </form>

                <hr class="my-4" />
                <p class="text-center text-muted mb-3">{{ __('auth.no_account') }}</p>
                <a href="{{ route('register') }}" class="btn btn-outline-dark w-100">
                    {{ __('auth.register_link') }}
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
