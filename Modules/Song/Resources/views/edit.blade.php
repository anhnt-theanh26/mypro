@extends('song::layouts.master')

@section('title', 'Thêm mới bài hát')

@push('push_css')
    <link rel="stylesheet" href="{{ asset('css/album/flatpickr.css') }}" />
@endpush

@section('content-child')
    <form action="{{ route('admin.song.update', $song) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <h5 class="card-header">Song </h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên bài hát</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $song->name }}" placeholder="Tên bài hát...">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="artist" class="form-label">Tên nghệ sĩ</label>
                            <input type="text" class="form-control" id="artist" name="artist"
                                value="{{ $song->artist }}" placeholder="Nghệ sĩ...">
                            @error('artist')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="album_id" class="form-label">Album</label>
                            <select id="album_id" name="album_id" class="form-select">
                                <option value="">No Album</option>
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}"
                                        {{ $song->album_id == $album->id ? 'selected' : '' }}>
                                        {{ $album->name }}({{ $album->artist }})</option>
                                @endforeach
                            </select>
                            @error('album_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lfm" class="form-label">Ảnh đại diện</label><br>
                            <input id="thumbnail" class="form-control" type="hidden" name="cover_art">
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
                                <div id="holder" class="mx-2" style="width: 100%">
                                    <img class="btn-image rounded-1 object-fit-contain" src="{{ asset($song->cover_art) }}"
                                        height="80px" alt="Image">
                                </div>
                            </div>
                            @error('cover_art')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lfms" class="form-label">Đường dẫn bài hát</label><br>
                            <input id="thumbnails" class="form-control" type="hidden" name="file_path">
                            <div class="d-flex align-items-center">
                                <div class="input-group" style="position: relative; display: inline-block; width: 80px;">
                                    <img id="img" class="btn-image rounded-1"
                                        src="{{ asset('./storage/default.jpg') }}" width="80px" alt="Image">
                                    <button id="lfms" data-input="thumbnails" data-preview="holders" type="button"
                                        class="btn btn-light btn-image rounded-1" id="choose-button"
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; background: rgba(0, 0, 0, 0.4); border: none; color: white; font-weight: bold; text-align: center;">
                                        Choose
                                    </button>
                                </div>
                                <div class="mx-2" style="width: 100%">
                                    <audio controls>
                                        <source id="mp3" src="{{ $song->file_path }}" type="audio/mpeg">
                                        {{ $song->name }}
                                    </audio>
                                </div>
                            </div>
                            @error('file_path')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Kiểu bài hát</label>
                            <select id="type" name="type" class="form-select">
                                <option value="normal" {{ $song->type == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="premium" {{ $song->type == 'premium' ? 'selected' : '' }}>Premium</option>
                            </select>
                            @error('type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Thời gian bài hát 'giây'</label>
                            <input type="number" class="form-control" id="duration" name="duration"
                                value="{{ $song->duration }}" placeholder="Duration...">
                            @error('duration')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="release_date" class="form-label">Ngày phát hàng</label>
                            <input type="text" class="form-control flatpickr-input active" name="release_date"
                                placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly"
                                value="{{ $song->release_date }}">
                            @error('release_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select id="category_id" name="category_id" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $song->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-warning waves-effect waves-light">Cập nhập</button>
        <a href="{{ route('admin.song.index') }}" class="btn btn-secondary waves-effect waves-light">Danh
            sách</a>
    </form>
@endsection

@push('push_js')
    <script src="{{ asset('js/album/flatpickr.js') }}"></script>
    <script src="{{ asset('js/album/forms-pickers.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        $('#lfm').filemanager('cover_art');
        $('#lfms').filemanager('file_path');
    </script>
@endpush
