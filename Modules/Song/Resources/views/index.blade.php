@extends('song::layouts.master')
@section('title', 'Danh sách bài nhạc')

@push('push_css')
@endpush

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">DataTables /</span> Song</h4>

    <div class="card">
        <h5 class="card-header">Song</h5>
        <div class="d-flex justify-content-end card-header my-0 py-0">
            <a class="btn btn-success" href="{{ route('admin.song.create') }}" class="text-muted float-end">Create</a>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-scrollableTable table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Artist</th>
                        <th>Song</th>
                        <th>Album</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('push_js')
    <script>
        let dataJson = @json($songs) ?? '';
        let table = 'song';
    </script>
    <script>
        'use strict';
        $(function() {
            var dt_scrollable_table = $('.dt-scrollableTable');

            if (dt_scrollable_table.length) {
                var dt_scrollableTable = dt_scrollable_table.DataTable({
                    data: dataJson,

                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'artist'
                        },
                        {
                            data: 'file_path'
                        },
                        {
                            data: 'album_id'
                        },
                        {
                            data: 'type'
                        },
                        {
                            data: 'category_id'
                        },
                        {
                            data: null
                        }
                    ],
                    columnDefs: [{
                            targets: 3,
                            render: function(data, type, full, meta) {
                                return `
                                    <audio controls>
                                        <source src="${full.file_path}" type="audio/mpeg">
                                        ${full.name}
                                    </audio>`
                                full.cover_art;
                            }
                        },
                        {
                            targets: 4,
                            render: function(data, type, full, meta) {
                                return full.album && full.album.name ? full.album.name : '';
                            }
                        },
                        {
                            targets: 5,
                            render: function(data, type, full, meta) {
                                let colorBg = 'light';
                                if (full.type === 'premium') {
                                    colorBg = 'warning';
                                }
                                return `
                                    <span class="badge rounded-pill text-bg-${colorBg}">${full.type}</span>
                                `;
                            }
                        },
                        {
                            targets: 6,
                            render: function(data, type, full, meta) {
                                return full.category.name;
                            }
                        },
                        {
                            targets: 7, // Cột Actions
                            title: 'Actions',
                            searchable: false,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                var editUrl = `/admin/${table}/${full.id}/edit`;
                                var deleteUrl = `/admin/${table}/${full.id}/delete`;
                                var restoreUrl = `/admin/${table}/${full.id}/restore`;
                                var destroyUrl = `/admin/${table}/${full.id}`;
                                if (full.deleted_at != null) {
                                    return (
                                        `
                                    <div class="d-inline-block">
                                        <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="text-primary ti ti-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <a href="${editUrl}" class="dropdown-item">Edit</a>
                                            <form action="${restoreUrl}" method="POST" style="display:inline;">
                                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                <input type="hidden" name="_method" value="POST">
                                                <button type="submit" class="dropdown-item text-success">Restore</button>
                                            </form>
                                            <form action="${destroyUrl}" class="destroy-form" method="POST" style="display:inline;">
                                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="dropdown-item text-danger" onclick="confirm_delete()">Destroy</button>
                                            </form>
                                        </div>
                                    </div>
                                    `
                                    );
                                }
                                return (
                                    `
                                <div class="d-inline-block">
                                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="text-primary ti ti-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                        <a href="${editUrl}" class="dropdown-item">Edit</a>
                                        <form action="${deleteUrl}" method="POST" style="display:inline;">
                                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="dropdown-item text-danger" onclick="confirm_delete()">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                `
                                );

                            }
                        }
                    ],
                    // Scroll options
                    scrollY: '300px',
                    scrollX: true,
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
                });
            }

            // Filter form control to default size
            // ? setTimeout used for multilingual table initialization
            setTimeout(() => {
                $('.dataTables_filter .form-control').removeClass('form-control-sm');
                $('.dataTables_length .form-select').removeClass('form-select-sm');
            }, 200);
        });


        function confirm_delete() {
            document.querySelectorAll('.destroy-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
