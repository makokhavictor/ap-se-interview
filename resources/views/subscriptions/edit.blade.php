@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"> {{ __('Amend active subscription') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('subscriptions.update', ['id' => $subscription->user_id, 'subscription'=>$subscription->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-group col-4 mb-2">
                    <label for="">Choose plan</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="plan_id">
                        @foreach($plans as $plan)
                        <option value="{{$plan->id}}" {{ ($plan->id == $subscription->plan_id) ? 'selected' : '' }}>
                            {{$plan->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="row mb-0">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>



            </form>
        </div>
    </div>
</div>
@endsection