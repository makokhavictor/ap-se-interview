<div class="row">
    <div class="col-3">
        <button class="btn btn-primary btn-sm" onclick="window.location='{{ route("plans.edit", ["plan"=>$model->id]) }}'">Edit</button>
    </div>
    <div class="col-3">
        <button class="btn btn-danger btn-sm">Delete</button>
    </div>
</div>