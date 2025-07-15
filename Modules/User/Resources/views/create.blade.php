@extends('category::layouts.master')

@section('title', 'Thêm mới tài khoản')

@push('push_css')
    <link rel="stylesheet" href="{{ asset('/css/user/flatpickr.css') }}" />
@endpush

@section('content-child')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.user.store') }}" method="post">
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
                                placeholder="Email người dùng" autofocus />
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu người dùng</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="******"
                                autofocus />
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ người dùng</label>
                            <textarea id="bootstrap-maxlength-example2" class="form-control bootstrap-maxlength-example" rows="3"
                                name="address" maxlength="255" placeholder="Địa chỉ người dùng"></textarea>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image">Ảnh người dùng</label><br>
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
                            <label for="phone" class="form-label">Số điện thoại người dùng</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Số điện thoại người dùng" autofocus />
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Sinh nhật người dùng</label>
                            <input type="text" class="form-control flatpickr-input active" name="birthday"
                                placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly">
                            @error('birthday')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success waves-effect waves-light">Thêm mới</button>
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary waves-effect waves-light">Danh sách</a>
                {{-- <a href="{{ route('admin.user.create') }}" class="btn btn-success waves-effect waves-light">Thêm mới</a> --}}
            </form>
        </div>
    </div>
@endsection

@push('push_js')
    <script src="{{ asset('/js/user/flatpickr.js') }}"></script>
    <script src="{{ asset('/js/user/forms-pickers.js') }}"></script>

    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endpush
