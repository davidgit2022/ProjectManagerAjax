@extends('layouts.app')
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <h2><b>{{ $pageName }} | {{ $componentName }}</b></h2>
                </div>
                <div class="float-left mb-2">
                    <a href="javascript:void(0)" onclick="add()" class="btn btn-success">Nuevo</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table-company">
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
            $('#table-company').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('companies.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data:'name',
                        dame:'name'
                    },
                    {
                        data:'action',
                        name:'action',
                        orderable:false

                    }
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
                url: "{{ route('companies.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#theModal').modal('hide');
                    $('#CityCompanyForm')[0].reset(); 
                    $('.error-message').hide();
                    let oTable = $('#table-company').DataTable();
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
        }
    </script>
@endpush
