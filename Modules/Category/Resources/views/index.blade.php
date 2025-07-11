@extends('category::layouts.master')

@section('title', 'Danh sách danh mục')

@push('push_css')
    @parent
@endpush

@section('content-child')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DataTables /</span> Basic</h4>

    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@push('push_js')
    @parent
    {{-- <script src="{{ asset('/admin/assets/js/tables-datatables-basic.js') }}"></script> --}}
    <script src="{{ asset('Modules/Category/Resources/assets/js/tables-datatables-basic.js') }}"></script>
@endpush
