@extends('user::layouts.master')

@section('title', 'Khôi phục tài khoản')

@push('push_css')
@endpush

@section('content-child')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DataTables /</span> User</h4>

    <div class="card">
        <h5 class="card-header">User</h5>
        <div class="d-flex justify-content-end card-header my-0 py-0">
            <a class="btn btn-success" href="{{ route('admin.user.create') }}" class="text-muted float-end">Create</a>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-scrollableTable table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Birthday</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('push_js')
    <script>
        let createUrl = "{{ route('admin.user.create') }}";
        var dataJson = @json($users);
        let table = 'user';
    </script>
    <script src="{{ asset('js/user/tables-datatables-extensions.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
