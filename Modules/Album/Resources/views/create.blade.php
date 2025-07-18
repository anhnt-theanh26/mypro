@extends('album::layouts.master')

@section('title', 'Thêm mới album')

@push('push_css')
    <link rel="stylesheet" href="{{ asset('css/album/flatpickr.css') }}" />
@endpush

@section('content-child')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.album.store') }}" method="post">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">Album</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên album</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên album"
                                autofocus value="{{ old('name') }}" />
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="artist" class="form-label">Nghệ sĩ</label>
                            <input type="text" class="form-control" id="artist" name="artist"
                                placeholder="Tên nghệ sĩ" autofocus value="{{ old('artist') }}" />
                            @error('artist')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="thumbnail">Ảnh Album</label><br>
                            <input id="thumbnail" class="form-control" type="hidden" name="thumbnail">
                            <div class="d-flex align-items-center">
                                <div class="input-group" style="position: relative; display: inline-block; width: 80px;">
                                    <img id="img" class="btn-image rounded-1"
                                        src="{{ asset('./storage/default.jpg') }}" width="80px" alt="Image">
                                    <button id="lfm" data-input="thumbnail" data-preview="holder" type="button"
                                        class="btn btn-light btn-image rounded-1" id="choose-button"
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; background: rgba(0, 0, 0, 0.4); border: none; color: white; font-weight: bold; text-align: center;">
                                        Choose
                                    </button>
                                </div>
                                <div id="holder" class="mx-2" style="width: 100%"></div>
                            </div>
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
                        <div class="mb-3">
                            <label class="switch switch-primary">
                                <input type="checkbox" class="switch-input" name="is_hot"
                                    {{ old('is_hot') ? 'checked' : '' }}>
                                <span class="switch-toggle-slider">
                                    <span class="switch-on">
                                        <i class="ti ti-check"></i>
                                    </span>
                                    <span class="switch-off">
                                        <i class="ti ti-x"></i>
                                    </span>
                                </span>
                                <span class="switch-label">Nổi bật</span>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success waves-effect waves-light">Thêm mới</button>
                <a href="{{ route('admin.album.index') }}" class="btn btn-secondary waves-effect waves-light">Danh
                    sách</a>
            </form>
        </div>
    </div>
@endsection

@push('push_js')
    <script src="{{ asset('js/album/flatpickr.js') }}"></script>
    <script src="{{ asset('js/album/forms-pickers.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endpush
