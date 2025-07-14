'use strict';

$(function () {
  var dt_scrollable_table = $('.dt-scrollableTable');

  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      data: createCategoryJson, // Dữ liệu từ PHP hoặc JSON API

      columns: [
        { data: 'name' },    // Cột Name
        { data: 'slug' },    // Cột Slug
        { data: 'is_hot' },  // Cột Status (will render)
        { data: 'image' },   // Cột Image (will render image)
        { data: null }       // Cột Action (will render)
      ],

      columnDefs: [
        {
          targets: 2, // Cột "is_hot"
          render: function (data, type, full) {
            const status = data === 1 ? 'Hot' : 'Not Hot';
            const badgeClass = data === 1 ? 'bg-label-danger' : 'bg-label-secondary';
            return `<span class="badge ${badgeClass}">${status}</span>`;
          }
        },
        {
          targets: 3, // Cột "Image"
          render: function (data, type, full) {
            // Kiểm tra nếu có hình ảnh, nếu không có thì hiển thị ảnh mặc định
            const imgSrc = data ? data : 'https://via.placeholder.com/50'; // ảnh placeholder
            return `<img src="${imgSrc}" alt="image" class="rounded-circle" width="50" height="50" />`;
          }
        },
        {
          targets: 4, // Cột "Actions"
          title: 'Actions',
          orderable: false,
          searchable: false,
          render: function (data, type, full) {
            return `
              <div class="d-inline-block">
                <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="text-primary ti ti-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end m-0">
                  <a href="javascript:;" class="dropdown-item">Details</a>
                  <a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>
                </div>
              </div>
              <a href="javascript:;" class="item-edit text-body ms-1"><i class="text-primary ti ti-pencil"></i></a>
            `;
          }
        }
      ],

      scrollY: '300px',
      scrollX: true,
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
    });
  }

  // Bỏ class size nhỏ nếu có
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 200);
});
