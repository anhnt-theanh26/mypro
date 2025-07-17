@extends('album::layouts.master')

@section('title', 'Khôi phục album')

@push('push_css')
@endpush

@section('content-child')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DataTables /</span> Album</h4>

    <div class="card">
        <h5 class="card-header">Album</h5>
        <div class="d-flex justify-content-end card-header my-0 py-0">
            <a class="btn btn-success" href="{{ route('admin.album.create') }}" class="text-muted float-end">Create</a>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-scrollableTable table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Artist</th>
                        <th>Thumbnail</th>
                        <th>Release Date</th>
                        <th>Hot</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('push_js')
    <script>
        let dataJson = @json($albums) ?? '';
        let table = 'album';
    </script>
    <script src="{{ asset('js/album/tables-datatables-extensions.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
