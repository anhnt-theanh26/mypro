@extends('category::layouts.master')

@section('title', 'Thêm mới danh mục')

@section('css')
    @parent
@endsection

@section('content-child')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.category.store') }}" method="post">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">Danh mục</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tên danh mục" autofocus />
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Ảnh danh mục</label>
                            <input class="form-control" type="file" id="formFile" name="image" />
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="switch switch-primary">
                                <input type="checkbox" class="switch-input" name="is_hot" checked="">
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
            </form>
        </div>
    </div>
@endsection

@section('js')
    @parent
@endsection
