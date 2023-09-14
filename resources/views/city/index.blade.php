@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <h2><b>{{ $pageName }} | {{ $componentName }}</b></h2>
                </div>
                <div class="float-sm-end mb-2 ">
                    <a href="javascript:void(0)" class="btn btn-success">Nuevo</a>
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

    @include('city.modals.form')
@endsection
@push('javascript')
    @include('ajax.cityAjax')
@endpush
