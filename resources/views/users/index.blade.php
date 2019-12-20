@extends('admin.home')
@section('content_header')
<h1 class="display-3">Usuarios</h1>
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
          <td>Email</td>
          <td>Fecha de creación</td>
          <td>Tipo de usuario</td>
          <td colspan=2>Acciones</td>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
          @if($user->typeofuser == 3)
          <td>Administrador</td>
          @elseif($user->typeofuser == 2)
          <td>Dueño</td>
          @elseif($user->typeofuser == 1)
          <td>Usuario</td>
          @endif
          <td style="width: 60px;">
            <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary"><i class="fa fas fa-edit"></i></a>
          </td>
          <td style="width: 60px;">
            <form action="{{ route('users.destroy', $user->id)}}" method="post" style="margin-bottom: 0rem;">
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
      <a style="margin: 19px;" href="{{ route('users.create')}}" class="btn btn-success">Nuevo usuario</a>
      @endif
    </div>
  </div>
</div>
@endsection