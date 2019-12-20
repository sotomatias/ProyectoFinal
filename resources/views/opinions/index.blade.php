<div class="row">
  <div class="col-sm-12">
    @if(session()->get('opinionsuccess'))
    <div class="alert alert-success">
      {{ session()->get('opinionsuccess') }}
    </div>
    @endif
    <table class="table table-striped">
      <thead>
        <tr>
          <td>Usuario</td>
          <td>Fecha y Hora</td>
          <td>Título</td>
          @if(Auth::user()->typeofuser === 3)
          <td colspan="2">Acciones</td>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($opinions as $opinion)
        <tr data-toggle="collapse" data-target="#{{$opinion->id}}" class="accordion-toggle">
          <td>{{$opinion->user->name}}</td>
          <td>{{Carbon\Carbon::parse($opinion->created_at)->format('d/m/Y H:i')}}</td>
          <td>{{$opinion->title}}</td>
          @if(Auth::user()->typeofuser === 3)
          <td class="adminResponsive" style="width: 60px;">
            <form action="{{ route('opinions.destroy', $opinion->id)}}" method="post" style="margin-bottom: 0rem;">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger adminResponsive" type="submit"><i class="fa fas fa-trash"></i></button>
            </form>
          </td>
          @endif
        </tr>
        <tr>
          <td colspan="3" class="hiddentablerow">
            <div class="accordian-body collapse text-left" id="{{$opinion->id}}">
              <p class="p-3 Anywhere">
                Usuario: {{$opinion->user->name}} <br>
                Título: {{$opinion->title}} <br>
                Opinión: {{$opinion->opinion}} <br>
                Fecha y Hora: {{Carbon\Carbon::parse($opinion->created_at)->format('d/m/Y H:i')}} <br>
              </p>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div>
      <a style="margin: 19px;" href="{{ route('home')}}" class="btn btn-info">Volver al menú</a>
    </div>
  </div>
</div>