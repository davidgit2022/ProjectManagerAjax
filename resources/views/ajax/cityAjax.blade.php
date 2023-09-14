<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table-cities').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cities.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        });

        /* Show Modal New City */
        $('.float-sm-end .btn-success').on('click', (event) => {
            $('#theModal').modal('show');
            $('#titleModal').html('CREAR CIUDAD')
            $('#btnSave').show();
            $('#btnUpdate').hide();
        });

        /* Close modal */
        $('.btnClose').on('click', (event) => {
            cancel()
        });

        /* Save City */
        $('#btnSave').on('click', (event) => {
            let formData = new FormData($('#cityForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('cities.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    cancel();
                    let tableCity = $('#table-cities').DataTable();
                    tableCity.ajax.reload();
                    toastr.clear,
                    toastr.success('Ciudad creado existosamente.')
                    $('.btnSave').attr("disabled", true);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        showErrors(errors);
                    }
                }
            })
        });

        /* Update city */
        $('#btnUpdate').on('click', (event) => {
            let formData = new FormData($('#cityForm')[0]);
            let id = $('#id').val();
            $.ajax({
                type: "POST",
                url: "cities/update/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    cancel();
                    let tableCity = $('#table-cities').DataTable();
                    tableCity.ajax.reload();
                    toastr.clear,
                    toastr.success('Ciudad actualizada existosamente.')
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        showErrors(errors);
                    }
                }
            })
        })


    });

    /* function edit  */
    function editfun(id) {
        $.ajax({
            type: "GET",
            url: "cities/edit/" + id,
            dataType: "json",
            success: function(res) {
                $('#theModal').modal('show');
                $('#titleModal').html('EDITAR CIUDAD ')
                $('#btnUpdate').show();
                $('#btnSave').hide();
                $('#id').val(res.id);
                $('#name').val(res.name)
            }
        })
    };

    /* function delete */
    function deleteFunc(id) {
        Swal.fire({
            title: 'Esta seguro?',
            text: "CONFIRMAS ELIMINAR EL REGISTRO!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borralo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "cities/delete/" + id,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(res) {
                        toastr.clear,
                        toastr.success('Ciudad eliminada existosamente.')
                        let tableCity = $('#table-cities').DataTable();
                        tableCity.ajax.reload();
                    }
                })

            }
        })
    };

    /* function cancel */
    function cancel() {
        $('#theModal').modal('hide');
        resetInputFields();
    };

    /* function clearFields */
    function resetInputFields() {
        $('#cityForm')[0].reset();
        $('.error-message').hide();
    };

    /* function show Errors */

    function showErrors(errors) {
        for (const error in errors) {
            let errorSpan = $('#' + error + 'Error');
            errorSpan.text(errors[error][0]);
            errorSpan.show();
        }
    };
</script>