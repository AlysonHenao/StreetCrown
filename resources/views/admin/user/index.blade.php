{{-- Author: Alyson Henao --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.user.index') }}" class="row g-3">
            <div class="col-md-6">
                <label for="search" class="form-label">{{ __('user.search') }}</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    class="form-control"
                    placeholder="{{ __('user.search_placeholder') }}"
                    value="{{ $viewData['search'] }}"
                >
            </div>

            <div class="col-md-4">
                <label for="role" class="form-label">{{ __('user.filter_role') }}</label>
                <select id="role" name="role" class="form-select">
                    <option value="">{{ __('user.all_roles') }}</option>
                    @foreach($viewData['roles'] as $roleKey => $roleLabel)
                        <option value="{{ $roleKey }}" {{ $viewData['role'] === $roleKey ? 'selected' : '' }}>
                            {{ $roleLabel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('user.search') }}
                </button>
            </div>
        </form>
    </div>
</div>

@if($viewData['users']->isEmpty())
    <div class="alert alert-info">
        {{ __('user.empty') }}
    </div>
@else
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-3">
                    <thead>
                        <tr>
                            <th>{{ __('user.id') }}</th>
                            <th>{{ __('user.name') }}</th>
                            <th>{{ __('user.email') }}</th>
                            <th>{{ __('user.role') }}</th>
                            <th>{{ __('user.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['users'] as $user)
                            <tr>
                                <td>{{ $user->getId() }}</td>
                                <td>{{ $user->getName() }}</td>
                                <td>{{ $user->getEmail() }}</td>
                                <td>{{ $user->getRole() }}</td>
                                <td>
                                    <a href="{{ route('admin.user.edit', ['id' => $user->getId()]) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        {{ __('user.edit_button') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $viewData['users']->links() }}
        </div>
    </div>
@endif
@endsection