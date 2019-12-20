@extends('admin.home')
@section('content_header')
<h1 class="display-3">Actualizar {{ $user->name }}</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br />
        @endif
        <form method="post" action="{{ route('users.update', $user->id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Nombre del usuario:</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" />
            </div>
            <div class="form-group">
                <label for="email">Email del usuario:</label>
                <input type="text" class="form-control" name="email" value="{{ $user->email }}" />
            </div>
            <div class="form-group">
                <label for="dob">Fecha de Nacimiento del usuario:</label>
                <input type="date" class="form-control" name="dob" disabled value="{{ $user->dateofbirth }}" />
            </div>
            <div class="form-group">
                <label for="typeofuser">Tipo de usuario:</label>
                <select name="typeofuser" class="form-control">
                    @if(old('typeofuser', $user->typeofuser) == 1))
                    <option value="1" selected>Usuario</option>
                    @else
                    <option value="1">Usuario</option>
                    @endif
                    @if(old('typeofuser', $user->typeofuser) == 2))
                    <option value="2" selected>Dueño</option>
                    @else
                    <option value="2">Dueño</option>
                    @endif
                    @if(old('typeofuser', $user->typeofuser) == 3))
                    <option value="3" selected>Administrador</option>
                    @else
                    <option value="3">Administrador</option>
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection