@extends('layouts.app')

@section('content')
<div class="container">
        <div class="card">
            <div class="card-header"> {{ __('Manage subscription plans') }}</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush