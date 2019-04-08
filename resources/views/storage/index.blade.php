@extends('layouts.master')

@section('content')

    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">File uploader</h6>
        <div class="media text-muted pt-3">
            <input id="file-uploader" type="text" name="url" class="form-control" placeholder="Paste URL to start file uploading" required="required">
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Uploaded files</h6>

        @foreach($models as $model)
            <div class="media text-muted pt-3">

                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">

                        <a href="#" title="Click to upload current file">
                            <strong class="text-gray-dark">{{ $model->url }}</strong>
                        </a>

                        <button type="button" class="btn btn-primary">Remove</button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection