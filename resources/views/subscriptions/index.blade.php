@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"> {{ __('User subscriptions details and history') }}</div>
        <div class="card-body">
            <div class="row">
                @if ($activeSubscription)
                <div class="alert alert-primary" role="alert">
                    This user has an active subscription and is due for renewal on {{ $expiryDate }}
                </div>
                @else
                <div class="alert alert-warning" role="alert">
                    This user does not have an active subscription
                </div>
                @endif
            </div>
            <div class="row">
                @if (session('warning'))
                <div class="alert">{{ session('warning') }}</div>
                @endif
            </div>
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts() }}
@endpush