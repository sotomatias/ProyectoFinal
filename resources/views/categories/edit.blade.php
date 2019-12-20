@extends('admin.home')
@section('content_header')
<h1 class="display-3">Actualizar {{ $category->name }}</h1>
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
        <form method="post" action="{{ route('categories.update', $category->category_id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">

                <label for="name">Nombre de la categoría:</label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}" />
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection