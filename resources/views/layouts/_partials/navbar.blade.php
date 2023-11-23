<div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home')}}">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @component('layouts._partials._components.nav-li')
                @slot('route')
                {{ route('cities.index')}}
                @endslot

                @slot('name','Ciudades' )

                
            @endcomponent
            @component('layouts._partials._components.nav-li')
                @slot('route')
                {{ route('companies.index')}}
                @endslot

                @slot('name','Compañias' )               
            @endcomponent

            @component('layouts._partials._components.nav-li')
                @slot('route')
                {{ route('projects.index')}}
                @endslot

                @slot('name','Proyects' )               
            @endcomponent

            {{-- <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('cities.index')}}">Ciudades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('companies.index')}}">Compañias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('projects.index')}}">Proyectos</a>
            </li> --}}
        </ul>
    </div>
</div>