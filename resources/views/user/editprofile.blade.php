<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BariFood | Editar Perfil</title>
  @include ('imports')
</head>

<body id="page-top">
  @include('user.navbar')
  <section class="page-section" id="portfolio">
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
    @if(session()->get('success'))
    <div class="row align-items-center justify-content-center">
      <div class="alert alert-success col-md-6">
        {{ session()->get('success') }}
      </div>
    </div>
    @endif
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="col-lg-12 text-center updateUser">
            <form method="post"
              action="{{ route('userProfile.edit', ['id' => Auth::user()->id, 'name' => Auth::user()->name]) }}"
              class="col-lg-6" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
              @if(auth()->user()->img_profile)
              <img class="imgProfile" src="{{ URL::asset('img/'.auth()->user()->img_profile)}}" />
              @else
              <img class="imgProfile" src="{{ URL::asset('img/profile.png')}}" />
              @endif
              <br>
              <i>Clickee en la foto para cambiarla.</i>
              <h3 class="section-heading text-uppercase">{{auth()->user()->name}}
                <br>
                {{auth()->user()->email}}</h3>
              <input type="file" id="img_profile" name="img_profile" style="display:none;"
                value="{{auth()->user()->img_profile}}">
              <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" style="text-align: center;"
                  value="{{auth()->user()->name}}" />
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" style="text-align: center;"
                  value="{{auth()->user()->email}}" />
              </div>
              <div class="form-group">
                <label for="dob">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" disabled style="text-align: center;"
                  value="{{auth()->user()->dateofbirth}}">
              </div>
              <div class="form-group">
                <label for="oldpassword">Contraseña Antigua:</label>
                <input type="password" class="form-control" name="oldpassword" style="text-align: center;">
              </div>
              <div class="form-group">
                <label for="newpassword">Contraseña Nueva:</label>
                <input type="password" class="form-control" name="newpassword" style="text-align: center;">
              </div>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('importsjs')
</body>

</html>