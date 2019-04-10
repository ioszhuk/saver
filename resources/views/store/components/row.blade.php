<div class="file-row media text-muted pt-3" data-file-row="{{ $model['id'] }}">

    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a href="/download/{{ $model['id'] }}" title="Click to upload current file">
                <strong class="text-gray-dark">{{ $model['file_name'] }}</strong>
            </a>
            <button type="button" data-id="{{ $model['id'] }}" class="btn btn-primary js-file-remove">Remove</button>
        </div>
    </div>

</div>