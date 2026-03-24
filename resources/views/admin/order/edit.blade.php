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

                <form method="POST" action="{{ route('admin.order.update', ['id' => $viewData['order']->getId()]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">{{ __('order.id') }}</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ $viewData['order']->getId() }}"
                            disabled
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('order.user') }}</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ $viewData['order']->getUser()->getName() }}"
                            disabled
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('order.email') }}</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ $viewData['order']->getUser()->getEmail() }}"
                            disabled
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('order.total') }}</label>
                        <input
                            type="text"
                            class="form-control"
                            value="${{ number_format($viewData['order']->getTotal(), 0, ',', '.') }}"
                            disabled
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('order.payment_method') }}</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ $viewData['order']->getPaymentMethod() }}"
                            disabled
                        >
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">{{ __('order.status') }}</label>
                        <select id="status" name="status" class="form-select">
                            @foreach($viewData['statuses'] as $statusKey => $statusLabel)
                                <option value="{{ $statusKey }}"
                                    {{ old('status', $viewData['order']->getStatus()) === $statusKey ? 'selected' : '' }}>
                                    {{ $statusLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if($viewData['order']->getItems()->count() > 0)
                        <div class="mb-3">
                            <label class="form-label">Items</label>
                            <ul class="list-group">
                                @foreach($viewData['order']->getItems() as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            {{ $item->getProduct()->getName() }} x {{ $item->getQuantity() }}
                                        </span>
                                        <span>
                                            ${{ number_format($item->calculateSubTotal(), 0, ',', '.') }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('order.update_button') }}
                        </button>

                        <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary">
                            {{ __('order.back_button') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection