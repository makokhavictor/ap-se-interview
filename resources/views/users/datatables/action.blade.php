<div class="row">
    <div class="col-3">
        <button class="btn btn-primary btn-sm" onclick="window.location='{{ route("subscriptions.index", $model->id) }}'">{{ __('View subscriptions') }}</button>
    </div>
</div>