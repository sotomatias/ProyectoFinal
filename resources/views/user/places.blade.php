<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BariFood | Lugares Disponibles</title>
  @include ('imports')
</head>

<body id="page-top">
  @include('user.navbar')
  <section class="bg-light page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <input type="text" autocomplete="off" name="search" id="search" class="form-control"
            placeholder="Buscar por Nombre o Dirección" />
          <select name="category" autocomplete="off" class="form-control" id="category">
            <option value="0">Elige una categoría..</option>
            @foreach($placecategories as $placecategory)
            <option value="{{$placecategory->id}}">{{$placecategory->name}}</option>
            @endforeach
          </select>
          <h2 class="section-heading text-uppercase">Lugares</h2>
          <h3 class="section-subheading text-muted">Los lugares que se encuentran en BariFood.</h3>
        </div>
      </div>
      @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
      @endif
      <div class="row searchepico">
  </section>
  <section class="bg-light page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Mapa</h2>
          <h3 class="section-subheading text-muted">Ubicación de los distintos restaurantes, bares y cafeterías.</h3>
        </div>
      </div>
      <div id="map" class="map">
      </div>
    </div>
  </section>
  @include('modalplaces')
  @include('importsjs')
  @include('user.searchFilter')
</body>

</html>