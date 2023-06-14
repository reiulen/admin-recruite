$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
    },
});

const table = $("#example1").DataTable({
    lengthMenu: [
        [10, 25, 50, 100, 500, -1],
        [10, 25, 50, 100, 500, "All"],
    ],
    searching: false,
    responsive: false,
    lengthChange: true,
    autoWidth: false,
    order: [],
    pagingType: "full_numbers",
    language: {
        search: "_INPUT_",
        searchPlaceholder: "Cari...",
        processing:
            '<div class="spinner-border text-info" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            "</div>",
        paginate: {
            Search: '<i class="icon-search"></i>',
            first: "<i class='fas fa-angle-double-left'></i>",
            previous: "<i class='fas fa-angle-left'></i>",
            next: "<i class='fas fa-angle-right'></i>",
            last: "<i class='fas fa-angle-double-right'></i>",
        },
    },
    oLanguage: {
        sSearch: "",
    },
    processing: true,
    serverSide: true,
    ajax: {
        url: `${url}/dashboard/dataTable`,
        method: "POST",
        data: function (d) {
            const input = $('input');
            const select = $('select');
            input.each(function() {
                let name = $(this).attr('name');
                let value = $(this).val();
                if (value != '')
                    d[name] = value;
            });
            select.each(function() {
                let name = $(this).attr('name');
                let value = $(this).val();
                if (value != '')
                    d[name] = value;
            });
            return d;
        },
    },
    columns: [
        {
            name: "created_at",
            data: "DT_RowIndex",
        },
        {
            name: "name",
            data: "name",
            orderable: false,
        },
        {
            name: "email",
            data: 'email',
            orderable: false,
        },
        {
            name: "phone",
            data: "phone",
            orderable: false,
        },
        {
            name: "hear_about_us",
            data: "hear_about_us",
            orderable: false,
        },
        {
            name: "submitted_at",
            data: "submitted_at",
            orderable: false,
        },
        {
            name: "action",
            data: "action",
            orderable: false,
        },

    ],
});

$('input').on('keyup', function() {
    setTimeout(function() {
        table.draw();
    }, 900);
}).on('change', function() {
    setTimeout(function() {
        table.draw();
    }, 900);
});

$('select').on('change', function() {
    table.draw();
});


table.on("click", ".btn-hapus", function (e) {
    e.preventDefault();
    const id = $(this).data("id");
    const nama = $(this).data("title");
    const urlTarget = `${url}/dashboard/${id}`
    deleteDataTable(nama, urlTarget, table)
});


$(function() {
    $('.btnAdd').on('click', function() {
        $('#modalInput').modal('show');
    });

    table.on('click', '.detail-data', async function() {
        const id = $(this).data('id');
        const urlTarget = `${url}/dashboard/${id}`;
        const res = await sendDataFile(urlTarget, 'GET', {});
        const data = res;
        const modal = $('#modalDetail');
        modal.modal('show');
        modal.find('#modalDetailBody').html(data);
    });

    $('.full-size').on('click', function() {
        const modal = $('#modalDetail');
        modal.find('.modal-dialog').toggleClass('modal-lg');
        modal.find('.modal-dialog').toggleClass('modal-xl');
    });

    $('#modalInput').on('hide.bs.modal', function (e) {
        const form = $(this).find('#submitInput');
        form.find('[name="id"]').val('');
        form.trigger('reset');
    });
})
