@extends('layouts.app-auth')

@section('content')
	<div class="row justify-content-center">
		<div class="col-lg-5">
			<div class="card shadow-lg border-0 rounded-lg mt-5">
				<div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar sesión</h3></div>
				<div class="card-body">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="form-group">
							<label for="username" class="small mb-1">Nombre de usuario</label>
							<input id="username" type="text" class="form-control py-4 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="off" autofocus>
							@error('username')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="password" class="small mb-1">Contraseña</label>
							<input id="password" type="password" class="form-control py-4 @error('password') is-invalid @enderror" name="password" required>
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-lg btn-block btn-primary">Iniciar sesión</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
