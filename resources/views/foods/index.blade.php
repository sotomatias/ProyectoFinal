<div class="row">
  <div class="col-sm-12">
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
    @endif
    <table class="table table-striped">
      <thead>
        <tr>
          <td>Nombre</td>
          <td>Descripción</td>
          <td>Precio</td>
          <td>Categoría</td>
          <td colspan=2>Acciones</td>
        </tr>
      </thead>
      <tbody>
        @foreach($foods as $food)
        <tr>
          <td>{{$food->name}}</td>
          <td>{{$food->description}}</td>
          <td>{{$food->price}}</td>
          <td>{{$food->category->name}}</td>
          <td style="width: 90.5px;">
            <a href="{{ route('foods.edit',$food->food_id)}}" class="btn btn-primary"><i class="fa fas fa-edit"></i></a>
          </td>
          <td style="width: 106px;">
            <form action="{{ route('foods.destroy', $food->food_id)}}" method="post" style="margin-bottom: 0rem;">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit"><i class="fa fas fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div>
      <a style="margin: 19px;" href="{{ route('home')}}" class="btn btn-info">Volver al menú</a>
      <a style="margin: 19px;" href="{{ route('foods.create', [$place->place_id])}}" class="btn btn-success">Nuevo
        plato</a>
    </div>
  </div>
</div>