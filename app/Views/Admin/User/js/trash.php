<script>
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();

        var uuid = $(this).data('uuid');
        Swal.fire({
            title: 'Confirmation Delete',
            html: '<p>Are you sure you want to Delete admin data ?</p>',
            icon: 'success',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Lanjutkan...',
            confirmButtonAriaLabel: 'Setuju',
            cancelButtonText: '<i class="fa fa-thumbs-down"></i> Batal...',
            cancelButtonAriaLabel: 'Tidak setuju',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-success mx-2',
                cancelButton: 'btn btn-danger mx-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "delete-admin/" + uuid,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        Swal.fire({
                            title: data.success ? 'Berhasil' : 'Faild',
                            text: data.message,
                            icon: data.success ? 'success' : 'error',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                        setInterval(function() {
                            window.location.reload();
                        }, 2000);
                        table.draw();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire(
                            'Error!',
                            'Something went wrong, please try again.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>