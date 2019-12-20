<script>
  function initMap() {
    if($("#map").length != 0){
      var bariloche = {lat: -41.145030, lng: -71.297005};
      var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 13, center: bariloche});
    }
      @foreach ($places as $place)
      const place{{$place->place_id}} = @json($place);
          var Latitud = place{{$place->place_id}}.latitud;
          var Longitud = place{{$place->place_id}}.longitud;
          var myLatlng = new google.maps.LatLng(Latitud,Longitud);
          var map{{$place->place_id}} = new google.maps.Map(
          document.getElementById('map{{$place->place_id}}'), {zoom: 16, center: myLatlng});
          var Titulo = place{{$place->place_id}}.name_place;
          var marker = new google.maps.Marker({
      position: myLatlng,
      map: map{{$place->place_id}},
      title: Titulo
  });
   if($("#map").length != 0){
    var markerPlaces = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: Titulo
   });
  }
  @endforeach
}
</script>