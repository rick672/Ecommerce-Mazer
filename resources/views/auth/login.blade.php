@php
    $ajuste = \App\Models\Ajuste::first();
    $imagen_login = $ajuste && $ajuste->imagen_login ? 'storage/'.$ajuste->imagen_login : 'assets/compiled/png/4853433.png';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ $ajuste->nombre ?? env('APP_NAME') }}</title>
    <!-- Solo mantener UN favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-4 col-md-5 col-12 p-0 d-flex justify-content-center align-items-center">
                <div id="auth-left">
                    <div class="text-center" style="margin-bottom: 2.5rem">
                        <a href="{{ url('/') }}">
                            <img src="{{ ($ajuste && $ajuste->logo) ? asset('storage/'.$ajuste->logo) : asset('assets/compiled/svg/logo.svg') }}" width="100" alt="Logo">
                        </a>
                    </div>
                    <h1 class="text-center">¡Bienvenido!</h1>
                    <p class="mb-5 text-center" style="color: #74788d;">
                        Inicia sesión para continuar en {{ $ajuste->name ?? env('APP_NAME') }}
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label class="form-label" for="email">Correo electrónico</label>
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <label class="form-label" for="password">Contraseña</label>
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-600" for="remember">
                                Mantenerme conectado
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3" style="font-size: 1.1rem">
                            Iniciar sesión
                        </button>
                    </form>
                    <div class="text-center mt-5 text-lg">
                        <p class="text-gray-600">
                            ¿No tienes cuenta? <a href="{{ route('register') }}" class="font-bold">Regístrate ahora.</a>
                        </p>
                        <p><a class="font-bold" href="{{ route('password.request') }}">¿Has olvidado tu contraseña?</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 d-none d-md-block p-0">
                <div id="auth-right">
                    <div 
                        style="
                            background-image: url('{{ asset($imagen_login) }}');
                            background-position: center;
                            background-repeat: no-repeat;
                            background-size: cover;
                            height: 100%;
                            width: 100%;
                        "
                    >
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
