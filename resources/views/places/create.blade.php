@extends('admin.home')
@section('content_header')
<h1 class="display-3">Agregar un lugar</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
    <div>
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div><br />
      @endif
      <form method="post" action="{{ route('places.store') }}" id="createPlaceForm" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="name_place">Nombre del lugar:</label>
          <input type="text" class="form-control" name="name_place" />
        </div>

        <div class="form-group">
          <label for="address_place">Dirección del lugar:</label>
          <input type="text" class="form-control" name="address_place" />
        </div>
        <div class="form-group">
          <label for="schedule_place">Horario del lugar:</label>
          <input type="text" class="form-control" name="schedule_place" />
        </div>
        <div class="form-group">
          <label for="phone_number">Teléfono del lugar:</label>
          <input type="text" class="form-control" name="phone_number" />
        </div>
        <div class="form-group">
          <label for="website">Sitio web del lugar:</label>
          <input type="text" id="website" class="form-control" name="website" />
        </div>
        <div class="form-group">
          <label for="category_id">Categoría del lugar:</label>
          <select name="category_id" class="form-control">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="user_id">Dueño del lugar:</label>
          <select name="user_id" class="form-control">
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->id }} - {{ $user->name }}</option>
            @endforeach
          </select>
        </div>
        <input type="text" hidden id="latitud" name="latitud">
        <input type="text" hidden id="longitud" name="longitud">
        <div id="map" style="width: 100%; height: 600px"></div>
        <button type="submit" class="btn btn-primary" id="submit-all">Añadir lugar</button>
      </form>
    </div>
  </div>
</div>
<script>
  function initMap() {
        var bariloche = {lat: -41.145030, lng: -71.297005};
        var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 13, center: bariloche, disableDoubleClickZoom: true});
google.maps.event.addListener(map,'click',function(event) {                
                document.getElementById('latitud').value = event.latLng.lat();
                document.getElementById('longitud').value =  event.latLng.lng();
            });
            google.maps.event.addListener(map,'dblclick',function(event) {
                var draggableMarker = new google.maps.Marker({
                  draggable: true,
                  position: event.latLng, 
                  map: map, 
                  title: event.latLng.lat()+', '+event.latLng.lng()
                });
                google.maps.event.addListener(draggableMarker, 'dragend', function() 
                {
                var draggableMarkerPosition = draggableMarker.getPosition();
                console.log(draggableMarkerPosition.lat());
                document.getElementById('latitud').value = draggableMarkerPosition.lat();
                document.getElementById('longitud').value = draggableMarkerPosition.lng();
                });
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrLlf6t-rvlTEujq-eY3Muj26wkdFzkmM&callback=initMap" async
  defer></script>
@endsection