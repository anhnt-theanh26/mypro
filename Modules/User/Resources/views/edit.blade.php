@extends('category::layouts.master')

@section('title', 'Thêm mới tài khoản')

@push('push_css')
    <link rel="stylesheet" href="{{ asset('css/user/flatpickr.css') }}" />
@endpush

@section('content-child')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card mb-4">
                    <h5 class="card-header">Người dùng</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" placeholder="Tên người dùng" autofocus />
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email người dùng</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" placeholder="Email người dùng" autofocus />
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ người dùng</label>
                            <textarea id="bootstrap-maxlength-example2" class="form-control bootstrap-maxlength-example" rows="3"
                                name="address" maxlength="255" placeholder="Địa chỉ người dùng">{{ $user->address }}</textarea>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image">Ảnh người dùng</label>
                            <input type="file" class="form-control" id="image" name="image" />
                            <img src="{{ asset($user->image) }}" alt="image" width="50px" id="img"
                                class="py-1">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại người dùng</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $user->phone }}" placeholder="Số điện thoại người dùng" autofocus />
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Sinh nhật người dùng</label>
                            <input type="text" class="form-control flatpickr-input active" name="birthday"
                                value="{{ $user->birthday }}" placeholder="YYYY-MM-DD" id="flatpickr-date"
                                readonly="readonly">
                            @error('birthday')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning waves-effect waves-light">Cập nhập</button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary waves-effect waves-light">Danh sách</a>
                <a href="{{ route('admin.user.create') }}" class="btn btn-success waves-effect waves-light">Thêm mới</a>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{ route('admin.user.password', $user) }}" method="post">
                @csrf
                @method('put')
                <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <label class="form-label" for="old_password">Old Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="old_password"
                                        value="{{ old('old_password') }}" placeholder="******" name="old_password" />
                                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i
                                            class="ti ti-eye-off"></i></span>
                                </div>
                                @error('old_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                @if (session('password_is_incorrect'))
                                    <p class="text-danger">{{ session('password_is_incorrect') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <label class="form-label" for="new_password">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new_password"
                                        value="{{ old('new_password') }}" placeholder="******" name="new_password" />
                                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i
                                            class="ti ti-eye-off"></i></span>
                                </div>
                                @error('new_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                @if (session('oldpassword_like_newpassword'))
                                    <p class="text-danger">{{ session('oldpassword_like_newpassword') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <label class="form-label" for="confirm_password">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control"
                                        id="confirm_password"value="{{ old('confirm_password') }}"
                                        placeholder="******" name="confirm_password" />
                                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i
                                            class="ti ti-eye-off"></i></span>
                                </div>
                                @error('confirm_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">Cập nhập</button>
                    </div>
                </div>
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
