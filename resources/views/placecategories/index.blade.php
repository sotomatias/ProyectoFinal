@extends('admin.home')
@section('content_header')
<h1 class="display-3">Categorías de Lugares</h1>
@endsection
@section('content')
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
          <td>ID</td>
          <td>Nombre</td>
          <td colspan=2>Acciones</td>
        </tr>
      </thead>
      <tbody>
        @foreach($placeCategories as $placeCategory)
        <tr>
          <td>{{$placeCategory->id}}</td>
          <td>{{$placeCategory->name}}</td>
          <td style="width: 60px;">
            <a href="{{ route('placecategories.edit',$placeCategory->id)}}" class="btn btn-primary"><i
                class="fa fas fa-edit"></i></a>
          </td>
          <td style="width: 60px;">
            <form action="{{ route('placecategories.destroy', $placeCategory->id)}}" method="post"
              style="margin-bottom: 0rem;">
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
      @if(Auth::user()->typeofuser === 3)
      <a style="margin: 19px;" href="{{ route('placecategories.create')}}" class="btn btn-success">Nuevo lugar</a>
      @endif
    </div>
  </div>
</div>
@endsection