@extends('admin.home')
@section('content_header')
<h1 class="display-3">Actualizar un plato</h1>
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
        <form method="post" action="{{ route('foods.update', $food->food_id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">

                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" value={{ $food->name }} />
            </div>

            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" class="form-control" name="description" value={{ $food->description }} />
            </div>

            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" class="form-control" name="price" value={{ $food->price }} />
            </div>
            <div class="form-group">
                <label for="cat_id">Categoría:</label>
                <select name="cat_id" class="form-control" style="-webkit-appearance: menulist;">
                    @foreach ($categories as $category)
                    @if(old('cat_id', $food->cat_id) == $category->category_id ))
                    <option value="{{ $category->category_id }}" selected>{{ $category->name}}</option>
                    @else
                    <option value="{{ $category->category_id }}">{{ $category->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection