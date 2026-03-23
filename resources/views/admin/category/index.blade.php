{{-- Author: Alyson Henao --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">{{ __('category.admin_list_subtitle') }}</h2>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
        {{ __('category.create_button') }}
    </a>
</div>

@if($viewData['categories']->isEmpty())
    <div class="alert alert-info">
        {{ __('category.empty') }}
    </div>
@else
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('category.name') }}</th>
                            <th>{{ __('category.description') }}</th>
                            <th>{{ __('category.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['categories'] as $category)
                            <tr>
                                <td>{{ $category->getId() }}</td>
                                <td>{{ $category->getName() }}</td>
                                <td>{{ $category->getDescription() }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('admin.category.edit', ['id' => $category->getId()]) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        {{ __('category.edit_button') }}
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.category.destroy', ['id' => $category->getId()]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            {{ __('category.delete_button') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection