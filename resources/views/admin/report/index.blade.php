{{-- Author: Alyson Henao --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="h5 mb-3">{{ __('report.sales_report_title') }}</h2>

        <p class="text-muted">
            {{ __('report.sales_report_description') }}
        </p>

        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.report.sales', ['format' => 'pdf']) }}"
               class="btn btn-danger">
                {{ __('report.download_pdf') }}
            </a>

            <a href="{{ route('admin.report.sales', ['format' => 'excel']) }}"
               class="btn btn-success">
                {{ __('report.download_excel') }}
            </a>
        </div>
    </div>
</div>
@endsection