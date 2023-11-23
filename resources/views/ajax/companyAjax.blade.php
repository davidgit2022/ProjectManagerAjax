<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table-company').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('companies.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    dame: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false

                }
            ],
            order: [
                [0, 'desc']
            ]
        });

        /* Show Modal New Company */
        $('.float-sm-end .btn-success').on('click', function(event) {
            $('#theModal').modal('show');
            $('#titleModal').html('CREAR COMPAÑIA');
            $('#btnSave').show();
            $('#btnUpdate').hide();
        });

        /* Create Company */
        $('#btnSave').on('click', (event) => {
            let formData = new FormData($('#companyForm')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('companies.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    cancel();
                    let tableCompany = $('#table-company').DataTable();
                    tableCompany.ajax.reload();
                    toastr.clear(),
                    toastr.success('Compañia creada existosamente.')
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        showErrors(errors);
                    }
                }
            });
        });

        /* Update Company */
        $('#btnUpdate').on('click', (event) => {
            let formData = new FormData($('#companyForm')[0]);
            let id = $('#id').val();
            $.ajax({
                type: "POST",
                url: "companies/update/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    cancel();
                    let tableCompany = $('#table-company').DataTable();
                    tableCompany.ajax.reload();
                    toastr.clear(),
                        toastr.success('Compañia actualizada existosamente.')
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        showErrors(errors);
                    }
                }
            })
        })

        /* Close Modal */
        $('.btnClose').on('click', (event) => {
            cancel()
        });

    });

    function editFun(id) {
        $.ajax({
            type: "GET",
            url: "companies/edit/" + id,
            dataType: "json",
            success: function(res) {
                $('#theModal').modal('show');
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#titleModal').html('EDITAR COMPAÑIA');
                $('#btnSave').hide();
                $('#btnUpdate').show();
            }
        })

    };

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
                    url: "companies/delete/" + id,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(res) {
                        toastr.clear,
                        toastr.success('Compañia eliminada existosamente.')
                        let tableCompany = $('#table-company').DataTable();
                        tableCompany.ajax.reload();
                    }
                })

            }
        })
    }

    function cancel() {
        $('#theModal').modal('hide');
        resetInputFields()
    };

    function resetInputFields() {
        $('#companyForm')[0].reset();
        $('.error-message').hide()
    };

    function showErrors(errors) {
        for (const error in errors) {
            let errorSpan = $('#' + error + 'Error');
            errorSpan.text(errors[error][0]);
            errorSpan.show();
        }
    }
</script>
