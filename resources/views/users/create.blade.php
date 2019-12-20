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
      <form method="post" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group">
          <label for="name">Nombre del usuario:</label>
          <input type="text" class="form-control" name="name" />
        </div>
        <div class="form-group">
          <label for="email">Email del usuario:</label>
          <input type="text" class="form-control" name="email" />
        </div>
        <div class="form-group">
          <label for="name">Contraseña del usuario:</label>
          <input type="text" class="form-control" name="password" />
        </div>
        <div class="form-group">
          <label for="typeofuser">Tipo de usuario:</label>
          <select name="typeofuser" class="form-control">
            <option value="1">Usuario</option>
            <option value="2">Dueño</option>
            <option value="3">Administrador</option>
          </select>
        </div>
        <button type="submit" class="btn btn-danger">Añadir categoría</button>
      </form>
    </div>
  </div>
</div>
@endsection