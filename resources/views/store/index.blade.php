@extends('layouts.master')

@section('content')

    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">File uploader</h6>
        <div class="media text-muted pt-3">
            <div class="col-12">
                <div id="alert-response"></div>
                <input id="file-uploader" type="text" name="url" class="form-control" placeholder="Paste URL to start file uploading" required="required">
            </div>
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded box-shadow">

        <h6 class="border-bottom border-gray pb-2 mb-0">Uploaded files</h6>

        <div id="file-list">
            @foreach($models as $model)
                @include('store.components.row')
            @endforeach
        </div>

    </div>

@endsection