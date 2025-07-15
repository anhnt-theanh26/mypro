@extends('category::layouts.master')

@section('title', 'Chỉnh sửa danh mục')

@push('push_css')
@endpush

@section('content-child')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.category.update', $category->id) }}" method="post">
                @csrf
                @method('put')
                <div class="card mb-4">
                    <h5 class="card-header">Danh mục</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $category->name }}" placeholder="Tên danh mục" autofocus />
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image">Image</label><br>
                            <input id="thumbnail" class="form-control" type="hidden" name="image">
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
                            <label class="switch switch-primary">
                                <input type="checkbox" class="switch-input" name="is_hot"
                                    {{ $category->is_hot == 1 ? 'checked' : '' }}>
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
                <button type="submit" class="btn btn-warning waves-effect waves-light">Cập nhập</button>
                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary waves-effect waves-light">Danh sách</a>
                <a href="{{ route('admin.category.create') }}" class="btn btn-success waves-effect waves-light">Thêm mới</a>
            </form>
        </div>
    </div>
@endsection

@push('push_js')
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endpush
