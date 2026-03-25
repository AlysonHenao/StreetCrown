{{-- Author: Alyson Henao --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                @if($errors->any())
                    <ul class="alert alert-danger list-unstyled mb-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('admin.user.update', ['user' => $viewData['user']->getId()]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">{{ __('user.name') }}</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ $viewData['user']->getName() }}"
                            disabled
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('user.email') }}</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ $viewData['user']->getEmail() }}"
                            disabled
                        >
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">{{ __('user.role') }}</label>
                        <select id="role" name="role" class="form-select">
                            @foreach($viewData['roles'] as $roleKey => $roleLabel)
                                <option value="{{ $roleKey }}"
                                    {{ old('role', $viewData['user']->getRole()) === $roleKey ? 'selected' : '' }}>
                                    {{ $roleLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('user.update_button') }}
                        </button>

                        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                            {{ __('user.back_button') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection