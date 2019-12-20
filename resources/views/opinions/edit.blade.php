@extends('admin.home')
@section('content_header')
<h1 class="display-3">Actualizar una opinión</h1>
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
        <form method="post" action="{{ route('opinions.update', $opinion->id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="cat_id">Usuario:</label>
                <select name="user_id" class="form-control" style="-webkit-appearance: menulist;">
                    @foreach ($users as $user)
                    @if(old('user_id', $user->id) == $opinion->user_id ))
                    <option value="{{ $user->id }}" selected>{{ $user->name}}</option>
                    @else
                    <option value="{{ $user->id }}">{{ $user->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cat_id">Lugar:</label>
                <select name="place_id" class="form-control" style="-webkit-appearance: menulist;">
                    @foreach ($places as $place)
                    @if(old('place_id', $place->place_id) == $opinion->place_id ))
                    <option value="{{ $place->place_id }}" selected>{{ $place->name_place}}</option>
                    @else
                    <option value="{{ $place->place_id }}">{{ $place->name_place}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Opinión:</label>
                <input type="text" class="form-control" name="opinion" value={{ $opinion->opinion }} />
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection