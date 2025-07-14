@extends('category::layouts.master')

@section('title', 'Danh sách danh mục')

@push('push_css')
@endpush

@section('content-child')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DataTables /</span> Category</h4>

    <div class="card">
        <h5 class="card-header">Category</h5>
        <div class="d-flex justify-content-end card-header my-0 py-0">
            <a class="btn btn-success" href="{{ route('admin.category.create') }}" class="text-muted float-end">Create</a>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-scrollableTable table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Is_hot</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@push('push_js')
    <script>
        let createCategoryUrl = "{{ route('admin.category.create') }}";
        var createCategoryJson = @json($categories);
    </script>
    <script src="{{ asset('js/category/tables-datatables-extensions.js') }}"></script>
@endpush
