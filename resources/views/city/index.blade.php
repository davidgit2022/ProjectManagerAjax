@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <h2><b>{{ $pageName }} | {{ $componentName }}</b></h2>
                </div>
                <div class="float-left mb-2">
                    <a href="javascript:void(0)" class="btn btn-success" onclick="add()">Nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table-cities">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('common.formCityCompany')
@endsection
@push('javascript')
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

            $('#cancelButton').on('click', function(event) {
                event.preventDefault();
                cancel();
            });
        });

        function store() {
            let formData = new FormData($('#CityCompanyForm')[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('cities.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#theModal').modal('hide');
                    $('#CityCompanyForm')[0].reset(); 
                    $('.error-message').hide();
                    let oTable = $('#table-cities').DataTable();
                    oTable.ajax.reload();
                    $("#save").attr("disabled", false);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        showErrors(errors);
                    }
                }
            });
        };

        function edit(id) {
            idCity = id;
            let botton = document.getElementById('buttonAction');
            if (id > 0) {
                let htmlContent =
                    '<button type="submit" onClick="update()" class="btn btn-primary" id="update">Actualizar</button>';
                botton.innerHTML = htmlContent
            }

            $.ajax({
                type: "GET",
                url: "{{ url('cities') }}/" + id + "/edit",
                dataType: 'json',
                success: function(res) {
                    $('#titleModal').html("Ciudades | Editar ");
                    $('#theModal').modal('show'),
                        $('#id').val(res.id);
                    $('#name').val(res.name);
                }
            })
        };

        function update() {
            let formData = $('#CityCompanyForm').serialize();
            $.ajax({
                type: 'PUT',
                url: '/cities/' + $('#id').val(),
                data: formData,
                success: function(data) {
                    $('#theModal').modal('hide');
                    let oTable = $('#table-cities').dataTable();
                    oTable.fnDraw(false);
                    $("#update").attr("disabled", false);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        showErrors(errors);
                    }
                }
            });
        };



        function deleteFunc(id) {
            if (confirm("Esta seguro de eliminar el registro?") == true) {

                $.ajax({
                    type: "DELETE",
                    url: '/cities/' + id,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#table-cities').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        };
    </script>
@endpush
