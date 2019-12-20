@foreach ($places as $place)
<div class="portfolio-modal modal fade" id="{{$place->name_place}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="close-modal" data-dismiss="modal">
        <div class="lr">
          <div class="rl"></div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="modal-body">
              <!-- Project Details Go Here -->
              <h3 class="text-uppercase">{{$place->name_place}}</h3>
              <h4 class="item-intro text-uppercase"><i class="fas fa-compass"></i> {{$place->address_place}}</h4>
              <h4 class="item-intro text-uppercase"><i class="fas fa-clock"></i> {{$place->schedule_place}}</h4>
              <h6 class="item-intro text-muted">Para ver la galería completa, haga clic en la imagen principal.</h6>
              <div class="d-flex">
                <div style="flex: 2 0 0;" class="thumbs">
                  @if($place->images->count() == 0)
                  <a data-exthumbimage="{{ URL::asset('storage/uploads/restaurante-jaizkibel-1.jpg')}}"
                    href="{{ URL::asset('storage/uploads/restaurante-jaizkibel-1.jpg')}}">
                    <img class="img-fluid d-block mx-auto"
                      src="{{ URL::asset('storage/uploads/restaurante-jaizkibel-1.jpg')}}"
                      style="width: 100%; height: 100%">
                  </a>
                  @endif
                  @foreach($place->images as $image)
                  @if($image->active_place == 1)
                  <a data-exthumbimage="{{ URL::asset('storage/uploads/'.$image->filename)}}"
                    href="{{ URL::asset('storage/uploads/'.$image->filename)}}">
                    <img class="img-fluid d-block mx-auto" src="{{ URL::asset('storage/uploads/'.$image->filename)}}"
                      style="width: 100%; height: 100%">
                  </a>
                  @else
                  <div data-exthumbimage="{{ URL::asset('storage/uploads/'.$image->filename)}}" style="display: none"
                    data-src="{{ URL::asset('storage/uploads/'.$image->filename)}}">
                  </div>
                  @endif
                  @endforeach
                </div>
                <div style="flex: 2 0 0;">
                  <div id="map{{$place->place_id}}" class="map d-block img-fluid mx-auto"
                    style="width: 100%; height: 100%"></div>
                  @include ('user.mapScript')
                </div>
              </div>
              <div class="Contenedor">
                <h4 class="item-intro text-uppercase">Comidas</h4>
                @foreach($categories as $category)
                @php
                $count = 0;
                @endphp
                @foreach($category->foods as $food)
                @if($food->place_id == $place->place_id)
                @break($count === 1)
                <li class="text-uppercase list-inline item-intro" style="text-align:left;">
                  <h5 class="DancingScript">{{$category->name}}</h5>
                </li>
                @php
                $count++;
                @endphp
                @endif
                @endforeach
                @foreach($place->foods as $food)
                @if($food->cat_id == $category->category_id)
                <ul class="list-inline">
                  <li style="text-align:left; font-size: 22px;" class="DancingScript">{{$food->name}}<span
                      style="float:right; font-size: 16px;">{{$food->price}}</span></li>
                  <li class="text-muted" style="text-align: left; font-style: italic; font-size: 14px;">
                    {{$food->description}}</li>
                </ul>
                @endif
                @endforeach
                @endforeach
              </div>
              <br>
              <div class="Contenedor">
                <h4 class="item-intro text-uppercase">Opiniones</h4>
                <button class="btn btn-primary mostrarFormulario">Escribir Opinión</button>
                <br>
                @if (Auth::check())
                <form method="post" class="formularioOpinion d-none"
                  action="{{ route('opinions.store', $place->place_id) }}">
                  @csrf

                  <div class="form-group">
                    <div class="col-md-3 float-left">
                      <label for="food">Comida:</label>
                      <select name="food">
                        @for ($i = 1; $i <= 10; $i++) <option value="{{$i}}">{{$i}}</option>
                          @endfor
                      </select>
                    </div>
                    <div class="col-md-3 float-left">
                      <label for="service">Servicio:</label>
                      <select name="service">
                        @for ($i = 1; $i <= 10; $i++) <option value="{{$i}}">{{$i}}</option>
                          @endfor
                      </select>
                    </div>
                    <div class="col-md-3 float-right">
                      <label for="prices">Precios:</label>
                      <select name="prices">
                        @for ($i = 1; $i <= 10; $i++) <option value="{{$i}}">{{$i}}</option>
                          @endfor
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 float-right">
                    <label for="atmosphere">Ambiente:</label>
                    <select name="atmosphere">
                      @for ($i = 1; $i <= 10; $i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="title">Título</label>
                    <input class="form-control" type="text" name="title">
                  </div>
                  <div class="form-group">
                    <label for="opinion">Opinión</label>
                    <textarea class="form-control" rows="3" name="opinion"></textarea>
                  </div>
                  <button class="btn btn-primary" type="submit">Enviar</button>
                </form>
                @endif
                <br>
                @foreach($place->opinions as $opinion)
                @php
                $columns = 4;
                $average = ($opinion->food + $opinion->service + $opinion->atmosphere + $opinion->prices) / $columns;
                @endphp
                <div class="d-flex" style="border: 1px solid black;">
                  <div style="flex: 1 0 0;">
                    <img class="imgProfile" style="width: 50%; margin-top: 10px; margin-bottom: 10px;"
                      src="{{ URL::asset('img/'.$opinion->user->img_profile)}}" />
                    <h4>{{$opinion->user->name}}</h4>
                    <br>
                  </div>
                  <div class="d-flex"
                    style="flex: 3 0 0; justify-content: center; align-items: center; flex-direction: column;">
                    <h4 style="flex: 1; margin-top: 5px;">{{$opinion->title}}</h4> <br>
                    <span style="flex: 1.5; word-break: break-all; padding-right: 10px;">{{$opinion->opinion}}</span>
                  </div>
                </div>
                <div class="d-flex"
                  style="border-top: 0px; justify-content: center; align-items: center; border: solid 1px;">
                  <span class="Opiniones">Servicio: {{$opinion->service}} </span>
                  <span class="Opiniones">Ambiente: {{$opinion->atmosphere}} </span>
                  <span class="Opiniones">Comida: {{$opinion->food}} </span>
                  <span class="Opiniones">Precios: {{$opinion->prices}} </span>
                  <span class="Opiniones">Promedio: @php echo $average @endphp</span>
                  <span class="PromedioOpiniones">Promedio General: @php echo $average @endphp</span>
                </div>
                <br>
                @endforeach
              </div>
              <button class="btn btn-primary" data-dismiss="modal" type="button">
                Volver atrás</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach