@if(Route::is('userProfile.index') || Route::is('indexPlaces'))
<nav class="navbar navbar-expand-lg navbar-dark fixed-top placesNavbar" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll-trigger" href="/">BariFood</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav text-uppercase ml-auto">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{route ('home')}}">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger {{ ! Route::is('indexPlaces') ?: 'active'}}"
            href="{{route ('indexPlaces')}}">Lugares</a>
        </li>
        @auth
        @if(Auth::user()->typeofuser === 2 || Auth::user()->typeofuser === 3)
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{route ('admin')}}">Panel de Administración</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger {{ ! Route::is('userProfile.index') ?: 'active'}}"
            href="{{ route('userProfile.index', ['id' => Auth::user()->id, 'name' => Auth::user()->name])}}">Mi
            Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{route ('login')}}">Iniciar sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{route ('register')}}">Registrarme</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
@else
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll-trigger" href="/">BariFood</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav text-uppercase ml-auto">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#services">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#portfolio">Lugares</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#contact">Contacto</a>
        </li>
        @auth
        @if(Auth::user()->typeofuser === 2 || Auth::user()->typeofuser === 3)
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{route ('admin')}}">{{ __('Panel de Administración') }}</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger"
            href="{{ route('userProfile.index', ['id' => Auth::user()->id, 'name' => Auth::user()->name])}}">{{ __(' Mi Perfil') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{route ('login')}}">Iniciar sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{route ('register')}}">Registrarme</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
@endif