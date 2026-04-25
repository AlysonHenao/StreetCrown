{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <div style="display: grid; gap: 0; border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden; margin-bottom: 1.5rem;">
                    @foreach([
                        __('profile.name') => $viewData['user']->getName(),
                        __('profile.email') => $viewData['user']->getEmail(),
                        __('profile.phone') => $viewData['user']->getPhone(),
                        __('profile.address') => $viewData['user']->getAddress(),
                        __('profile.city') => $viewData['user']->getCity(),
                        __('profile.postal_code') => $viewData['user']->getPostalCode(),
                    ] as $label => $value)
                        <div style="display: flex; padding: 0.875rem 1rem; border-bottom: 1px solid var(--c-border); background: var(--c-surface);">
                            <span style="font-size: 0.68rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--c-muted); width: 140px; flex-shrink: 0;">{{ $label }}</span>
                            <span style="font-size: 0.88rem; color: var(--c-text);">{{ $value ?? '—' }}</span>
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100">
                    {{ __('profile.edit_button') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection