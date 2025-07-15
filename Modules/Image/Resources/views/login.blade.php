@extends('image::layouts.master')

@section('title', 'Images')

@push('push_css')
@endpush

@section('content-child')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">Danh mục</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tên danh mục" autofocus />
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Tên danh mục" />
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Tên danh mục" />
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success waves-effect waves-light">Thêm mới</button>
            </form>
        </div>
    </div>
@endsection

@push('push_js')
@endpush
