<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BariFood | Restaurantes, bares y cafeterías de Bariloche</title>

  @include ('imports')

</head>

<body id="page-top">

  <!-- Navigation -->
  @include('user.navbar')
  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-heading text-uppercase">BariFood</div>
        <div class="intro-lead-in" style=" text-shadow: 1px 2px #484848;">Sitio web de restaurantes, bares y cafeterías
          de Bariloche.</div>
        <!-- <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a> -->
      </div>
    </div>
  </header>

  <!-- Services -->
  <section class="page-section" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">¿Qué podés hacer en la página?</h2>
          <h3 class="section-subheading text-muted">Te mostramos algunas de las cosas que podés hacer.</h3>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Ver Restaurantes</h4>
          <p class="text-muted">¿No sabes dónde comer? ¿Querés un restaurante con alguna comida en específico? ¿Quizás
            solamente ir a una cafetería? ¿Un bar? Podés mirar todas las opciones disponibles que hay en la ciudad y
            elegir la que más te guste.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Opinar</h4>
          <p class="text-muted">Tu opinión ayuda a crecer tanto a los distintos comercios como a la página web. Por eso,
            podés opinar sobre los distintos lugares disponibles, además de dar feedback sobre la página.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Administrar</h4>
          <p class="text-muted">¿Sos dueño de un restaurante, un bar o una cafetería y querés que tu lugar aparezca en
            nuestra web? Podés contactarte con nosotros para que aparezca, y te daremos un panel para que puedas editar
            tu local: Dirección, horarios y comidas.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio Grid -->
  <section class="bg-light page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Lugares</h2>
          <h3 class="section-subheading text-muted">Algunos de los lugares que se encuentran en nuestra página.</h3>
        </div>
      </div>
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
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
      @endif
      <div class="row">
        @php
        $count = 0;
        @endphp
        @foreach ($places->shuffle() as $place)
        @break($count == 6)
        <div class="col-md-4 col-sm-6 portfolio-item">
          <a class="portfolio-link" data-toggle="modal" href="#{{$place->name_place}}"
            data-target="#{{$place->name_place}}">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            @foreach($place->images as $image)
            @if($image->active_place == 1)
            <img class="img-fluid" src="{{ URL::asset('storage/uploads/'.$image->filename)}}"
              style="width:400px; height:262.5px;">
            @endif
            @endforeach
            @if($place->images->count() == 0)
            <img class="img-fluid" src="{{ URL::asset('storage/uploads/restaurante-jaizkibel-1.jpg')}}"
              style="width:400px; height:262.5px;">
            @endif
          </a>
          <div class="portfolio-caption">
            <h4 class="text-uppercase">{{$place->name_place}}</h4>
            <p class="text-muted">{{$place->address_place}}</p>
          </div>
        </div>
        @php
        $count++;
        @endphp
        @endforeach
        <div class="col-md-5 col-sm-4"></div>
        @php
        if($count == 1){
        echo '<div class="col-md-5 col-sm-4"></div>';
        }
        @endphp
        <a class="col-md-2 col-sm-4 btn btn-primary" href="/places">
          <i class="far fa-hand-point-right"></i>
          Ver todos</a>
        <div class="col-md-5 col-sm-4"></div>
      </div>
  </section>

  <!-- About -->
  <!-- <section class="page-section" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">About</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul class="timeline">
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="{{ URL::asset('template/img/about/1.jpg') }}" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>2009-2011</h4>
                    <h4 class="subheading">Our Humble Beginnings</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="{{ URL::asset('template/img/about/2.jpg') }}" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>March 2011</h4>
                    <h4 class="subheading">An Agency is Born</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="{{ URL::asset('template/img/about/3.jpg') }}" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>December 2012</h4>
                    <h4 class="subheading">Transition to Full Service</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="{{ URL::asset('template/img/about/4.jpg') }}" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>July 2014</h4>
                    <h4 class="subheading">Phase Two Expansion</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <h4>Be Part
                    <br>Of Our
                    <br>Story!</h4>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section> -->

  <!-- Team -->
  <!-- <section class="bg-light page-section" id="team">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="team-member">
              <img class="mx-auto rounded-circle" src="{{ URL::asset('template/img/team/1.jpg') }}" alt="">
              <h4>Kay Garland</h4>
              <p class="text-muted">Lead Designer</p>
              <ul class="list-inline social-buttons">
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="team-member">
              <img class="mx-auto rounded-circle" src="{{ URL::asset('template/img/team/2.jpg') }}" alt="">
              <h4>Larry Parker</h4>
              <p class="text-muted">Lead Marketer</p>
              <ul class="list-inline social-buttons">
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="team-member">
              <img class="mx-auto rounded-circle" src="{{ URL::asset('template/img/team/3.jpg') }}" alt="">
              <h4>Diana Pertersen</h4>
              <p class="text-muted">Lead Developer</p>
              <ul class="list-inline social-buttons">
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
          </div>
        </div>
      </div>
    </section> -->

  <!-- Clients -->
  <!-- <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="{{ URL::asset('template/img/logos/envato.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="{{ URL::asset('template/img/logos/designmodo.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="{{ URL::asset('template/img/logos/themeforest.jpg') }}" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="{{ URL::asset('template/img/logos/creative-market.jpg') }}" alt="">
            </a>
          </div>
        </div>
      </div>
    </section> -->

  <!-- Contact -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Contacto</h2>
          <!-- <h3 class="section-subheading text-muted">Para poder ayudarte.</h3> -->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" id="name" type="text" placeholder="Tu nombre... *" required="required"
                    data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" type="email"
                    placeholder="Tu dirección de correo electrónico... *" required="required"
                    data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" type="tel" placeholder="Tu número de teléfono... *"
                    required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" placeholder="Tu mensaje... *" required="required"
                    data-validation-required-message="Please enter a message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Enviar
                  Mensaje</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  {{-- Footer --}}
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <span class="copyright">Copyright &copy; Matías Soto 2019</span>
        </div>
        <div class="col-md-6">
          <span class="copyright">Proyecto Final - 6to Informática</span>
        </div>
      </div>
    </div>
  </footer>

  <!-- Portfolio Modals -->

  <!-- Modal 1 -->
  @include('modalplaces')
  @include('importsjs')
</body>

</html>