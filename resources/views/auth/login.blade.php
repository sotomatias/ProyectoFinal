<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>BariFood | Iniciar sesión</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	@include('auth.imports')
</head>

<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('img/bg-restaurante.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form method="POST" action="{{ route('login') }}">
					@csrf
					<span class="login100-form-title p-b-49">
						Iniciar sesión
					</span>
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div><br />
					@endif
					<div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
						<span class="label-input100">Dirección de correo electrónico</span>
						<input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email"
							value="{{ old('email') }}" autocomplete="email" placeholder="Type your email address" autofocus>
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Contraseña</span>
						<input id="password" class="input100 @error('password') is-invalid @enderror" type="password"
							name="password" placeholder="Type your password" required autocomplete="current-password">
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<div class="text-right p-t-8 p-b-31">
						@if (Route::has('password.request'))
						<a href="#">
							Olvidaste tu contraseña?
						</a>
						@endif
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Iniciar sesión
							</button>
						</div>
					</div>
					<div class="flex-col-c p-t-155">
						<a href="/register" class="txt2">
							Registrarme
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>