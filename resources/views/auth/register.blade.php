{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', __('auth.register_subtitle'))

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
                    <h2 class="h4 fw-bold mb-1">{{ __('auth.register_title') }}</h2>
                    <p class="text-muted mb-0">{{ __('auth.register_subtitle') }}</p>
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

                <form method="POST" action="{{ route('register') }}" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">{{ __('auth.name') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                            </span>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="{{ __('auth.name_placeholder') }}"
                                autocomplete="name"
                                autofocus
                                required
                            />
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

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
                                autocomplete="new-password"
                                required
                            />
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">{{ __('auth.password_confirm') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                </svg>
                            </span>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="form-control"
                                placeholder="{{ __('auth.password_placeholder') }}"
                                autocomplete="new-password"
                                required
                            />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        {{ __('auth.register_button') }}
                        <svg width="6" height="6" viewBox="0 0 6 6" fill="currentColor" class="ms-2" aria-hidden="true">
                        </svg>
                    </button>
                </form>

                <hr class="my-4" />
                <p class="text-center text-muted mb-3">{{ __('auth.have_account') }}</p>
                <a href="{{ route('login') }}" class="btn btn-outline-dark w-100">
                    {{ __('auth.login_link') }}
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
