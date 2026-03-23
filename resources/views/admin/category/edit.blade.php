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

                <form method="POST"
                      action="{{ route('admin.category.update', ['id' => $viewData['category']->getId()]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('category.name') }}</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $viewData['category']->getName()) }}"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('category.description') }}</label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            rows="3"
                        >{{ old('description', $viewData['category']->getDescription()) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('category.update_button') }}
                        </button>

                        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">
                            {{ __('category.back_button') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection