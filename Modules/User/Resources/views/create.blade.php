@extends('category::layouts.master')

@section('title', 'Thêm mới tài khoản')

@push('push_css')
    <link rel="stylesheet" href="{{ asset('css/user/flatpickr.css') }}" />
@endpush

@section('content-child')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">Người dùng</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tên người dùng" autofocus />
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email người dùng</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email người dùng" value="{{ old('email') }}" />
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <label class="form-label" for="password">Mật khẩu người dùng</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" placeholder="******"
                                        name="password" />
                                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i
                                            class="ti ti-eye-off"></i></span>
                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ người dùng</label>
                            <textarea id="bootstrap-maxlength-example2" class="form-control bootstrap-maxlength-example" rows="3"
                                name="address" maxlength="255" placeholder="Địa chỉ người dùng">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image">Ảnh người dùng</label>
                            <input type="file" class="form-control" id="image" name="image"
                                value="{{ old('image') }}" placeholder="image" />
                            <img src="" alt="" width="50px" id="img" class="py-1">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại người dùng</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Số điện thoại người dùng" value="{{ old('phone') }}" />
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Sinh nhật người dùng</label>
                            <input type="text" class="form-control flatpickr-input active" name="birthday"
                                placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly"
                                value="{{ old('birthday') }}">
                            @error('birthday')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success waves-effect waves-light">Thêm mới</button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary waves-effect waves-light">
                    Danh sách
                </a>
            </form>
        </div>
    </div>
@endsection

@push('push_js')
    <script src="{{ asset('js/user/flatpickr.js') }}"></script>
    <script src="{{ asset('js/user/forms-pickers.js') }}"></script>
    <script>
        // 1 ảnh
        var image = document.querySelector('#image');
        var img = document.querySelector('#img');
        image.addEventListener('change', function(e) {
            e.preventDefault();
            img.src = URL.createObjectURL(this.files[0]);
        })
    </script>
@endpush
