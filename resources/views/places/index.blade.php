@extends('admin.home')
@section('content_header')
<h1 class="display-3">Lugares</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-sm-12 table-responsive">
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
    @endif
    <table class="table table-striped">
      <thead>
        <tr>
          <td>Nombre</td>
          <td>Dirección</td>
          <td colspan="2">Acciones</td>
        </tr>
      </thead>

      <tbody>
        @foreach($places as $place)
        <tr data-toggle="collapse" data-target="#{{$place->place_id}}" class="accordion-toggle">
          <td class="">{{$place->name_place}}</td>
          <td class="">{{$place->address_place}}</td>
          <td class="adminResponsive" style="width: 60px;">
            <a href="{{ route('places.edit',$place->place_id)}}" class="btn btn-primary adminResponsive"><i
                class="fa fas fa-edit"></i></a>
          </td>
          @if(Auth::user()->typeofuser === 3)
          <td class="adminResponsive" style="width: 60px;">
            <form action="{{ route('places.destroy', $place->place_id)}}" method="post" style="margin-bottom: 0rem;">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger adminResponsive" type="submit"><i class="fa fas fa-trash"></i></button>
            </form>
          </td>
          @endif
        </tr>
        <tr>
          <td colspan="3" class="hiddentablerow">
            <div class="accordian-body collapse text-left" id="{{$place->place_id}}">
              <p class="p-3">
                Nombre: {{$place->name_place}} <br>
                Dirección: {{$place->address_place}} <br>
                Horario: {{$place->schedule_place}} <br>
                Categoría: {{$place->placeCategory->name}} <br>
                Web: {{$place->website}} <br>
                Teléfono: {{$place->phone_number}} <br>
                @foreach ($place->images as $image)
                @if($image->active_place =='1')
                Imagen Activa:
                <br>
                <img class="imgResponsive" src="{{ URL::asset('storage/uploads/'.$image->filename)}}"
                  style="padding-bottom: 10px;">
                <br>
                @endif
                @endforeach
                Otras imágenes:
                <br>
                @foreach ($place->images as $image)
                @if($image->active_place =='0')
                <img style="width: 10%; padding-top: 4px; vertical-align: bottom;"
                  src="{{ URL::asset('storage/uploads/'.$image->filename)}}">
                @endif
                @endforeach
              </p>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="p-3">
      <a style="margin: 5px;" href="{{ route('home')}}" class="btn btn-info">Ir al Inicio</a>
      @if(Auth::user()->typeofuser === 3)
      <a style="margin: 5px;" href="{{ route('places.create')}}" class="btn btn-success">Nuevo lugar</a>
      @endif
    </div>
  </div>
</div>
@endsection