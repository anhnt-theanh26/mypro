@extends('song::layouts.master')

@section('title', 'Thêm mới bài hát')

@push('push_css')
    <link rel="stylesheet" href="{{ asset('css/album/flatpickr.css') }}" />
@endpush

@section('content-child')
    <form action="">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Song </h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tên bài hát...">
                        </div>
                        <div class="mb-3">
                            <label for="artist" class="form-label">Artist</label>
                            <input type="text" class="form-control" id="artist" name="artist"
                                placeholder="Nghệ sĩ...">
                        </div>
                        <div class="mb-3">
                            <label for="album" class="form-label">Album</label>
                            
                        </div>
                        <div class="mb-3">
                            <label for="file_path" class="form-label">File path</label>
                            <input type="text" class="form-control" id="file_path" name="file_path"
                                placeholder="File path...">
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration (thời gian bài hát 'giây')</label>
                            <input type="number" class="form-control" id="duration" name="duration"
                                placeholder="Duration...">
                        </div>
                        <div class="mb-3">
                            <label for="release_date" class="form-label">Ngày phát hàng</label>
                            <input type="text" class="form-control flatpickr-input active" name="release_date"
                                placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly"
                                value="{{ old('release_date') }}">
                            @error('release_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
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
    <script src="{{ asset('js/album/flatpickr.js') }}"></script>
    <script src="{{ asset('js/album/forms-pickers.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endpush
