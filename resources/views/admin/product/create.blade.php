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

                <form method="POST" action="{{ route('admin.product.store') }}">
                    @csrf
                    @include('admin.product._form', [
                        'product' => null,
                        'categories' => $viewData['categories'],
                        'exclusiveCategory' => $viewData['exclusiveCategory'],
                        'submitText' => __('product.save_button')
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection