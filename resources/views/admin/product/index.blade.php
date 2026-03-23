{{-- Author: Alyson Henao --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">{{ __('product.admin_list_subtitle') }}</h2>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
        {{ __('product.create_button') }}
    </a>
</div>

@if($viewData['products']->isEmpty())
    <div class="alert alert-info">
        {{ __('product.empty') }}
    </div>
@else
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('product.name') }}</th>
                            <th>{{ __('product.brand') }}</th>
                            <th>{{ __('product.price') }}</th>
                            <th>{{ __('product.category') }}</th>
                            <th>{{ __('product.exclusive') }}</th>
                            <th>{{ __('product.active') }}</th>
                            <th>{{ __('product.stock') }}</th>
                            <th>{{ __('product.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['products'] as $product)
                            <tr>
                                <td>{{ $product->getId() }}</td>
                                <td>{{ $product->getName() }}</td>
                                <td>{{ $product->getBrand() }}</td>
                                <td>{{ number_format($product->getPrice(), 0, ',', '.') }} COP</td>
                                <td>{{ $product->getCategory()->getName() }}</td>
                                <td>{{ $product->getExclusive() ? 'Sí' : 'No' }}</td>
                                <td>{{ $product->getActive() ? 'Sí' : 'No' }}</td>
                                <td>{{ $product->getStock() }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('admin.product.edit', ['id' => $product->getId()]) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        {{ __('product.edit_button') }}
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.product.destroy', ['id' => $product->getId()]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            {{ __('product.delete_button') }}
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