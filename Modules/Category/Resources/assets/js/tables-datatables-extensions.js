'use strict';


$(function () {
    var dt_scrollable_table = $('.dt-scrollableTable');

    if (dt_scrollable_table.length) {
        var dt_scrollableTable = dt_scrollable_table.DataTable({
            data: dataJson,

            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'slug' },
                { data: 'is_hot' },
                { data: 'image' },
                { data: null }
            ],
            columnDefs: [
                {
                    // Label
                    targets: 3,
                    render: function (data, type, full, meta) {
                        const status = data === 1 ? 'Hot' : 'Not Hot';
                        const badgeClass = data === 1 ? 'bg-label-danger' : 'bg-label-secondary';
                        return `<span class="badge ${badgeClass}">${status}</span>`
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        const imgSrc = data ? data : 'https://static.thenounproject.com/png/1077596-200.png';
                        return `<img src="${imgSrc}" alt="image" class="rounded-circle" width="50" height="50" />`;
                    }
                },
                {
                    targets: 5, // Cột Actions
                    title: 'Actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
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
        form.addEventListener('submit', function (e) {
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