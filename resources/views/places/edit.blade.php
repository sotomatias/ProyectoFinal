@extends('admin.home')
@section('content_header')
<h1 class="display-3">Editar</h1>
@endsection
@section('content')
<div class="row col-sm-12">
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
        <form method="post" id="createPlaceForm" action="{{ route('places.update', $place->place_id) }}"
            enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <input type="hidden" id="place_id" value="{{ $place->place_id }}" />
                <label for="name">Nombre del lugar:</label>
                <input type="text" class="form-control" name="name_place" value="{{ $place->name_place }}" />
            </div>

            <div class="form-group">
                <label for="address_place">Dirección del lugar:</label>
                <input type="text" class="form-control" name="address_place" value="{{ $place->address_place }}" />
            </div>
            <div class="form-group">
                <label for="schedule_place">Horario del lugar:</label>
                <input type="text" class="form-control" name="schedule_place" value="{{ $place->schedule_place }}" />
            </div>
            <div class="form-group">
                <label for="images_place">Imagenes subidas:</label>
                <br>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
                    @foreach($place->images as $image)
                    <div class="{{$image->id}}" style="vertical-align: top; display: inline-block; text-align: center;">
                        @if($image->active_place == '1')
                        <img class="ImageActive imgResponsive"
                            src="{{ URL::asset('storage/uploads/'.$image->filename)}}" id="{{$image->id}}"
                            style="width: 100%; height: auto; vertical-align: bottom; height: 75%; padding: 10px;">
                        @else
                        <img class="imgResponsive" src="{{ URL::asset('storage/uploads/'.$image->filename)}}"
                            id="{{$image->id}}"
                            style="width: 100%; height: auto; vertical-align: bottom;  height: 75%; padding: 10px;">
                        @endif
                        <a href="{{ route('places.deleteimage', $image->id) }}" data-imgid="{{$image->id}}"
                            data-method="delete" class="jquery-postback {{$image->id}}">Borrar</a>
                        <a href="{{ route('places.activeimage', $image->id) }}" data-imgid="{{$image->id}}"
                            data-method="patch" class="jquery-postback {{$image->id}}">Activo</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label>Subir imagenes:</label>
                <div class="dropzone" id="mydropzone">
                </div>
            </div>
            @if($type == 3)
            <div class="form-group">
                <label for="category_id">Categoría del lugar:</label>
                <select name="category_id" class="form-control select">
                    @foreach ($placeCategories as $category)
                    @if(old('category_id', $place->category_id) == $category->id ))
                    <option value="{{ $category->id }}" selected>{{ $category->name}}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            @endif
            @if($type == 3)
            <div class="form-group">
                <label for="schedule_place">Dueño del lugar:</label>
                <select name="user_id" class="form-control" style="-webkit-appearance: menulist;">
                    @foreach ($users as $user)
                    @if(old('user_id', $place->user_id) == $user->id ))
                    <option value="{{ $user->id }}" selected>{{ $user->name}}</option>
                    @else
                    <option value="{{ $user->id }}">{{ $user->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            @endif
            <button type="submit" class="btn btn-primary" id="submit-all">Actualizar</button>
        </form>
    </div>
</div>
<div class="row p-3">
    <h1 class="display-3 p-3">Menú</h1>
</div>
@include('foods.index')
<div class="row p-3">
    <h1 class="display-3 p-3">Opiniones</h1>
</div>
@include('opinions.index')
@endsection
@section('ImportsJS')
<script src="{{ URL::asset('js/dropzone.js') }}"></script>
<script src="{{ URL::asset('js/dropzone-config.js') }}"></script>
@endsection