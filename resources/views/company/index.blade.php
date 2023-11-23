@extends('layouts.app')
@section('title', 'companies')
@section('content')
    @component('_components.table')
        @slot('pageName')
            {{ $pageName }}
        @endslot

        @slot('componentName')
            {{ $componentName }}
        @endslot

        @slot('table')
            <table class="table" id="table-company">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        @endslot
    @endcomponent
    @include('company.formCompany')
@endsection

@section('javascript')
    @include('ajax.companyAjax')
@endsection
