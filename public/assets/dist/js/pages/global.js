$('.select2').select2({});
$(".logout").click(function () {
    const nama = $(this).data("nama");
    Swal.fire({
        title: "Apakah yakin?",
        text: `Are you sure want to logout ?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#6492b8da",
        cancelButtonColor: "#d33",
        confirmButtonText: "Logout",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            const logout = `${url}/logout`;
            const formLogout = $('#logoutForm');
            formLogout.attr('action', logout);
            formLogout.submit();
        }
    });
});

$('.deleteData').on('click', function() {
    let name = $(this).data('name');
    let id = $(this).data('id');
    Swal.fire({
        title: "Apakah yakin?",
        text: `Data ${name} will be deleted`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#6492b8da",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $(`#form-hapus${id}`).submit();
        }
    });
})

$('.changeTA').on('change', function() {
    $('#formChangeTH').trigger('submit');
});

function deleteDataTable(nama, urlTarget, table) {
    Swal.fire({
        title: "Apakah yakin?",
        text: `Data ${nama} will be deleted`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#6492b8da",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yakin",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlTarget,
                method: "post",
                data: [{ name: "_method", value: "DELETE" }],
                success: function (res) {
                    table.draw();
                    Swal.fire(`Success delete`, res.message, "success");
                },
                error: function (res) {
                    console.log(res);
                    Swal.fire(`Gagal`, `${res.responseJSON.message}`, "error");
                },
            });
        }
    });
}

async function sendData(url, type, data) {
    const config = {
        method: type,
        url: url,
        data: data,
    };
    const result = await axios(config)
                    .then((res) => res.data)
                    .then(async (res) => {
                        return res;
                    }).catch(async (err) => {
                        Swal.fire(`Gagal`, err.responseJSON.message, "error");
                        return err.response;
                    });

    return result;
}


async function sendDataFile(url, type, data) {
    const header = {
        "Content-Type": "multipart/form-data",
    };

    const config = {
        method: type,
        url: url,
        header: header,
        data: data
    };

    const result = await axios(config)
                    .then((res) => res.data)
                    .then(async (res) => {
                        return res;
                    }).catch(async (err) => {
                        Swal.fire(`Gagal`, err.responseJSON.message, "error");
                        return err.response;
                    });

    return result;
}
