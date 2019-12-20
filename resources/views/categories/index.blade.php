@extends('admin.home')
@section('content_header')
<h1 class="display-3">Categoría de Comidas</h1>
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
        @foreach($categories as $category)
        <tr>
          <td>{{$category->category_id}}</td>
          <td>{{$category->name}}</td>
          <td style="width: 60px;">
            <a href="{{ route('categories.edit',$category->category_id)}}" class="btn btn-primary"><i
                class="fa fas fa-edit"></i></a>
          </td>
          <td style="width: 60px;">
            <form action="{{ route('categories.destroy', $category->category_id)}}" method="post"
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
      <a style="margin: 19px;" href="{{ route('categories.create')}}" class="btn btn-success">Nueva categoría</a>
    </div>
  </div>
</div>
@endsection