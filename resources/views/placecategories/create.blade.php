@extends('admin.home')
@section('content_header')
<h1 class="display-3">Agregar una categoría</h1>
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
      <form method="post" action="{{ route('placecategories.store') }}">
        @csrf
        <div class="form-group">
          <label for="name">Nombre de la categoría:</label>
          <input type="text" class="form-control" name="name" />
        </div>
        <button type="submit" class="btn btn-danger">Añadir categoría</button>
      </form>
    </div>
  </div>
</div>
@endsection