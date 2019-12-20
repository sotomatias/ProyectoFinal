@extends('admin.home')
@section('content_header')
<h1 class="display-3">Agregar una opinión</h1>
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
      <form method="post" action="{{ route('opinions.store') }}">
        @csrf
        <div class="form-group">
          <label for="user_id">Usuario:</label>
          <select name="user_id" class="form-control">
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->id }} - {{ $user->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="place_id">Lugar:</label>
          <select name="place_id" class="form-control">
            @foreach ($places as $place)
            <option value="{{ $place->place_id }}">{{ $place->place_id }} - {{ $place->name_place }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="opinion">Opinión:</label>
          <input type="text" class="form-control" name="opinion" />
        </div>
        <button type="submit" class="btn btn-danger">Añadir opinión</button>
      </form>
    </div>
  </div>
</div>
@endsection