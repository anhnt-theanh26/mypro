@extends('category::layouts.master')

@section('title', 'Xem danh mục')

@push('push_css')
@endpush

@section('content-child')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Danh mục</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="name" name="name" disabled
                            value="{{ $category->name }}" placeholder="Tên danh mục" autofocus />
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="image">Image</label><br>
                        <input id="thumbnail" class="form-control" type="hidden" name="image">
                        <div class="d-flex align-items-center">
                            <div id="holder" class="mx-2" style="width: 100%">
                                <img class="btn-image rounded-1 object-fit-contain" src="{{ asset($category->image) }}"
                                    height="80px" alt="Image">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="switch switch-primary">
                            <input type="checkbox" class="switch-input" name="is_hot"
                                {{ $category->is_hot == 1 ? 'checked' : '' }} disabled>
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
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary waves-effect waves-light">Danh
                sách</a>
            <a href="{{ route('admin.category.create') }}" class="btn btn-success waves-effect waves-light">Thêm mới</a>
        </div>
    </div>
@endsection

@push('push_js')
@endpush
