<!DOCTYPE html>
<html lang="en">

<head>
	<title>BariFood | Registrarame</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	@include('auth.imports')
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('img/bg-restaurante.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form method="POST" action="{{ route('register') }}">
					@csrf
					<span class="login100-form-title p-b-49">
						Registro
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
						<span class="label-input100">Nombre</span>
						<input id="name" type="text" class="input100 @error('name') is-invalid @enderror" name="name"
							value="{{ old('name') }}" required autocomplete="name" autofocus>
						@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-23" data-validate="e-mail is required">
						<span class="label-input100">Dirección de correo electrónico</span>
						<input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email"
							value="{{ old('email') }}" autocomplete="email" required placeholder="Type your email address" autofocus>
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Date of birth is required">
						<span class="label-input100">Fecha de nacimiento</span>
						<input id="dob" type="date" class="input100 @error('dob') is-invalid @enderror" name="dob" required>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Contraseña</span>
						<input id="password" class="input100 @error('password') is-invalid @enderror" type="password"
							name="password" placeholder="Type your password" required autocomplete="new-password" autofocus>
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Confirmar contraseña</span>
						<input id="password-confirm" type="password" class="input100" name="password_confirmation" required
							autocomplete="new-password" autofocus>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<div class="text-right p-t-8 p-b-31">
						@if (Route::has('password.request'))
						<a href="/login">
							Ya tenés una cuenta? Inicia sesión
						</a>
						@endif
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Registrarme
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>