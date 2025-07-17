@extends('product::layouts.master')

@section('title', 'Thêm mới danh mục')

@push('push_css')
@endpush

@section('content-child')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DataTables /</span> Product</h4>

    <div class="card">
        <h5 class="card-header">Product</h5>
        <div class="d-flex justify-content-end card-header my-0 py-0">
            <a class="btn btn-success" href="{{ route('admin.product.create') }}" class="text-muted float-end">Create</a>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-scrollableTable table">
                <thead>
                    <tr>
                        <th>Sku</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Hot</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('push_js')
@endpush
