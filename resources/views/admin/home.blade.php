<!doctype html>
<html lang="en">

<head>
  <title>BariFood | Panel de Administración</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  @include('admin.imports')
</head>

<body>
  @routes
  <div class="wrapper">
    <div class="sidebar" data-color="danger" data-background-color="white">
      <div class="logo">
        <a href="{{ route ('home') }}" class="simple-text logo-normal">
          BariFood
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ ! Route::is('places.*') ?: 'active'}} {{ ! Route::is('foods.*') ?: 'active'}} ">
            <a class="nav-link" href="/admin/places">
              <i class="material-icons">map</i>
              <p>Lugares</p>
            </a>
          </li>
          @if(Auth::user()->typeofuser == 3)
          <li class="nav-item  {{ ! Route::is('placecategories.*') ?: 'active' }}  ">
            <a class="nav-link" href="/admin/placecategories">
              <i class="material-icons">list</i>
              <p>Categorías de Lugares</p>
            </a>
          </li>
          <li class="nav-item  {{ ! Route::is('categories.*') ?: 'active' }}   ">
            <a class="nav-link" href="/admin/categories">
              <i class="material-icons">fastfood</i>
              <p>Categorías de Comidas</p>
            </a>
          </li>
          <li class="nav-item   {{ ! Route::is('users.*') ?: 'active' }}  ">
            <a class="nav-link" href="/admin/users">
              <i class="material-icons">verified_user</i>
              <p>Usuarios</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="/">
              <i class="material-icons">home</i>
              <p>Página Principal</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            @yield('content_header')
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link"
                  href="{{ route('userProfile.index', ['id' => Auth::user()->id, 'name' => Auth::user()->name])}}">
                  <i class="material-icons">account_circle</i> {{Auth::user()->name}}
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="material-icons">vpn_key</i> Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="content" style="padding-left: 0px; padding-right: 0px;">
        <div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
          @if(Route::is('admin'))
          <h3 class="text-center">Bienvenido {{auth::user()->name}}!</h3>
          @endif
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  @include('admin.importsjs')
  @yield('ImportsJS')
</body>

</html>