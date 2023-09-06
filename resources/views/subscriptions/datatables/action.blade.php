<div class="row">
    <div class="col-3">
            <button class="btn btn-primary btn-sm" onclick="window.location='{{ route("subscriptions.edit", ["id" => $model->user_id, "subscription" => $model->id]) }}'">{{ __('Edit Plan') }}</button>
    </div>
</div>