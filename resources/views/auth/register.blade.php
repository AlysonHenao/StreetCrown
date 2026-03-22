{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', __('auth.register_subtitle'))

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-5">

        <div class="auth-card">
            <div class="auth-card__icon-wrapper mb-4">
                <div class="auth-card__crown-icon">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 26L8 12L14 20L18 8L22 20L28 12L32 26H4Z" fill="currentColor"/>
                        <rect x="4" y="27" width="28" height="4" rx="2" fill="currentColor"/>
                    </svg>
                </div>
                <h2 class="auth-card__title">{{ __('auth.register_title') }}</h2>
                <p class="auth-card__subtitle">{{ __('auth.register_subtitle') }}</p>
            </div>

            @if ($errors->any())
                <div class="auth-alert auth-alert--error mb-3">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" class="me-2 flex-shrink-0">
                        <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm0 2a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-1 4h2v4H7V7z"/>
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <div class="auth-form__group mb-3">
                    <label for="name" class="auth-form__label">
                        {{ __('auth.name') }}
                    </label>
                    <div class="auth-form__input-wrapper">
                        <span class="auth-form__input-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </span>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            class="auth-form__input @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="{{ __('auth.name_placeholder') }}"
                            autocomplete="name"
                            autofocus
                            required
                        />
                    </div>
                </div>

                <div class="auth-form__group mb-3">
                    <label for="email" class="auth-form__label">
                        {{ __('auth.email') }}
                    </label>
                    <div class="auth-form__input-wrapper">
                        <span class="auth-form__input-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                            </svg>
                        </span>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="auth-form__input @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="{{ __('auth.email_placeholder') }}"
                            autocomplete="email"
                            required
                        />
                    </div>
                </div>

                <div class="auth-form__group mb-3">
                    <label for="password" class="auth-form__label">
                        {{ __('auth.password') }}
                    </label>
                    <div class="auth-form__input-wrapper">
                        <span class="auth-form__input-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            </svg>
                        </span>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="auth-form__input @error('password') is-invalid @enderror"
                            placeholder="{{ __('auth.password_placeholder') }}"
                            autocomplete="new-password"
                            required
                        />
                    </div>
                </div>

                <div class="auth-form__group mb-4">
                    <label for="password_confirmation" class="auth-form__label">
                        {{ __('auth.password_confirm') }}
                    </label>
                    <div class="auth-form__input-wrapper">
                        <span class="auth-form__input-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            </svg>
                        </span>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="auth-form__input"
                            placeholder="{{ __('auth.password_placeholder') }}"
                            autocomplete="new-password"
                            required
                        />
                    </div>
                </div>

                <button type="submit" class="auth-btn w-100 mb-3">
                    {{ __('auth.register_button') }}
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" class="ms-2">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </button>
            </form>

            <div class="auth-card__divider">
                <span>{{ __('auth.have_account') }}</span>
            </div>

            <a href="{{ route('login') }}" class="auth-btn auth-btn--outline w-100 mt-3 d-flex justify-content-center">
                {{ __('auth.login_link') }}
            </a>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    .auth-card {
        background: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 1rem;
        padding: 2.5rem 2rem;
        margin-top: 1rem;
        box-shadow: 0 4px 24px rgba(0,0,0,.06), 0 1px 4px rgba(0,0,0,.04);
    }

    .auth-card__icon-wrapper { text-align: center; }

    .auth-card__crown-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #212529;
        color: #fff;
        margin-bottom: .75rem;
    }

    .auth-card__title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: .25rem;
        letter-spacing: -.02em;
    }

    .auth-card__subtitle {
        color: #6c757d;
        font-size: .9rem;
        margin-bottom: 0;
    }

    .auth-alert {
        display: flex;
        align-items: flex-start;
        padding: .75rem 1rem;
        border-radius: .5rem;
        font-size: .875rem;
    }
    .auth-alert--error {
        background: #fff5f5;
        border: 1px solid #feb2b2;
        color: #c53030;
    }

    .auth-form__label {
        display: block;
        font-size: .875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: .4rem;
    }

    .auth-form__input-wrapper { position: relative; }

    .auth-form__input-icon {
        position: absolute;
        left: .875rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
        display: flex;
        align-items: center;
    }

    .auth-form__input {
        width: 100%;
        padding: .65rem .875rem .65rem 2.5rem;
        border: 1.5px solid #d1d5db;
        border-radius: .5rem;
        font-size: .95rem;
        color: #1f2937;
        background: #fafafa;
        transition: border-color .2s, box-shadow .2s, background .2s;
        outline: none;
    }

    .auth-form__input:focus {
        border-color: #212529;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(33,37,41,.1);
    }

    .auth-form__input.is-invalid { border-color: #e53e3e; }

    .auth-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: .7rem 1.5rem;
        border-radius: .5rem;
        font-weight: 600;
        font-size: .95rem;
        cursor: pointer;
        transition: background .2s, transform .1s, box-shadow .2s;
        text-decoration: none;
        border: 2px solid #212529;
        background: #212529;
        color: #fff;
    }

    .auth-btn:hover {
        background: #000;
        border-color: #000;
        color: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,.2);
        transform: translateY(-1px);
    }

    .auth-btn:active { transform: translateY(0); }

    .auth-btn--outline {
        background: transparent;
        color: #212529;
    }

    .auth-btn--outline:hover {
        background: #212529;
        color: #fff;
    }

    .auth-card__divider {
        position: relative;
        text-align: center;
        margin-top: 1.25rem;
    }

    .auth-card__divider::before,
    .auth-card__divider::after {
        content: '';
        position: absolute;
        top: 50%;
        width: calc(50% - 5.5rem);
        height: 1px;
        background: #e5e7eb;
    }

    .auth-card__divider::before { left: 0; }
    .auth-card__divider::after  { right: 0; }

    .auth-card__divider span {
        font-size: .8rem;
        color: #9ca3af;
        background: #fff;
        padding: 0 .75rem;
    }

    @media (max-width: 576px) {
        .auth-card { padding: 1.75rem 1.25rem; }
    }
</style>
@endpush