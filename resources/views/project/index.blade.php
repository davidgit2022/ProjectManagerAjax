@extends('layouts.app')
@section('title', 'projects')
@section('content')
    <div class="container mt-2">
        {{-- <div class="row">
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
                <table class="table" id="table-project">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Presupuesto</th>
                            <th>Fecha de ejecución</th>
                            <th>Estado</th>
                            <th>Ciudad</th>
                            <th>Compañia</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> --}}

        @component('_components.table')
            @slot('pageName')
                {{ $pageName }}
            @endslot

            @slot('componentName')
                {{ $componentName }}
            @endslot

            @slot('table')
                <table class="table" id="table-project">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Presupuesto</th>
                            <th>Fecha de ejecución</th>
                            <th>Estado</th>
                            <th>Ciudad</th>
                            <th>Compañia</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            @endslot
        @endcomponent
    </div>
    @include('project.formProject')
@endsection
@section('javascript')
    @include('ajax.projectAjax')
@endsection
