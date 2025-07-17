@extends('song::layouts.master')

@section('title', 'Thêm mới bài hát')

@push('push_css')
@endpush

@section('content-child')
    <form action="">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Title </h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title...">
                        </div>
                        <div class="mb-3">
                            <label for="artist" class="form-label">Artist</label>
                            <input type="text" class="form-control" id="artist" name="artist" placeholder="Artist...">
                        </div>
                        <div class="mb-3">
                            <label for="album" class="form-label">Album</label>
                            <input type="text" class="form-control" id="album" name="album" placeholder="Album...">
                        </div>
                        <div class="mb-3">
                            <label for="file_path" class="form-label">File path</label>
                            <input type="text" class="form-control" id="file_path" name="file_path" placeholder="File path...">
                        </div>
                         <div class="mb-3">
                            <label for="duration" class="form-label">Duration (thời gian bài hát 'giây')</label>
                            <input type="number" class="form-control" id="duration" name="duration" placeholder="Duration...">
                        </div>
                    </div>
                </div>

                <!-- Range -->
                <div class="card mb-4">
                    <h5 class="card-header">Range</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formRange1" class="form-label">Example range</label>
                            <input type="range" class="form-range" id="formRange1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Switches</h5>
                    <div class="card-body">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox
                                input</label>
                        </div>
                    </div>
                </div>

                <!-- Range -->
                <div class="card mb-4">
                    <h5 class="card-header">Range</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formRange1" class="form-label">Example range</label>
                            <input type="range" class="form-range" id="formRange1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('push_js')
@endpush
