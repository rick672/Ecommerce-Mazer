@php
    $ajuste = \App\Models\Ajuste::first();
    $imagen_login =
        $ajuste && $ajuste->imagen_login ? 'storage/' . $ajuste->imagen_login : 'assets/compiled/png/4853433.png';
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VELORUM</title>
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">

    <style>
        /* Solo mejora de colores - VELORUM */
        :root {
            --velorum-gold: #D4AF37;
            --velorum-gold-hover: #B8960C;
            --velorum-bg: #F5F3F0;
            --velorum-card: #FFFFFF;
            --velorum-text: #1A1A1A;
            --velorum-text-light: #6B6B6B;
            --velorum-border: #E8E4DD;
        }

        body {
            background: var(--velorum-bg);
        }

        #auth {
            background: var(--velorum-bg);
        }

        #auth-left {
            background: var(--velorum-card);
            border-radius: 25px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
        }

        /* Logo - sin cambios */
        #auth-left img {
            max-height: 80px;
        }

        /* Textos */
        #auth-left h2 {
            color: var(--velorum-text);
        }

        #auth-left p {
            color: var(--velorum-text-light);
        }

        /* Inputs */
        .form-control {
            background: var(--velorum-card);
            border: 1px solid var(--velorum-border);
            border-radius: 12px;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            color: var(--velorum-text);
        }

        .form-control:focus {
            border-color: var(--velorum-gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-control-icon {
            position: absolute;
            left: 3px !important;
            top: 10px !important;
            color: var(--velorum-text-light);
        }

        /* Botón */
        .btn-primary {
            background: var(--velorum-gold) !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 0.75rem !important;
            font-weight: 600 !important;
        }

        .btn-primary:hover {
            background: var(--velorum-gold-hover) !important;
            transform: translateY(-1px);
        }

        /* Links */
        .text-links a {
            color: var(--velorum-text-light);
            text-decoration: none;
        }

        .text-links a:hover {
            color: var(--velorum-gold);
        }

        /* Checkbox */
        .form-check-input:checked {
            background-color: var(--velorum-gold);
            border-color: var(--velorum-gold);
        }

        /* Capa negra opaca sobre la imagen */
        #auth-right {
            position: relative;
        }

        #auth-right::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            /* 0.4 = 40% opacidad, ajusta este valor */
            z-index: 1;
        }

        #auth-right>div {
            position: relative;
            z-index: 0;
        }
    </style>
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-xl-4 col-md-6 col-12 p-0 d-flex justify-content-center align-items-center">
                <div id="auth-left">
                    <div class="text-center" style="margin-bottom: 1rem">
                        <a href="{{ url('/') }}">
                            <img src="{{ $ajuste && $ajuste->logo ? asset('storage/' . $ajuste->logo) : asset('assets/compiled/svg/logo.svg') }}"
                                width="80" alt="Logo">
                        </a>
                    </div>
                    <h2 class="text-center">¡Bienvenid@!</h2>
                    <p class="mb-5 text-center" style="color: #74788d;">
                        Inicia sesión para continuar en {{ $ajuste->nombre ?? env('APP_NAME') }}
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label class="form-label m-0" for="email">Correo electrónico</label>
                        <div class="form-group position-relative has-icon-left mb-2">
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
                        <label class="form-label m-0" for="password">Contraseña</label>
                        <div class="form-group position-relative has-icon-left mb-2">
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
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-600" for="remember">
                                Mantenerme conectado
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3" style="font-size: 1.1rem">
                            Iniciar sesión
                        </button>
                    </form>
                    <div class="text-center mt-5 text-lg">
                        <p class="text-links" style="margin-bottom: .3rem">
                            ¿No tienes cuenta? <a href="{{ route('register') }}" class="font-bold">Regístrate
                                ahora.</a>
                        </p>
                        <p class="text-links"><a class="font-bold" href="{{ route('password.request') }}">¿Has olvidado
                                tu contraseña?</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-6 d-none d-md-block p-0">
                <div id="auth-right">
                    <div
                        style="
                            background-image: url('{{ asset($imagen_login) }}');
                            background-position: center;
                            background-repeat: no-repeat;
                            background-size: cover;
                            height: 100%;
                            width: 100%;
                        ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


{{-- @php
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
                    <div class="text-center" style="margin-bottom: 1rem">
                        <a href="{{ url('/') }}">
                            <img src="{{ ($ajuste && $ajuste->logo) ? asset('storage/'.$ajuste->logo) : asset('assets/compiled/svg/logo.svg') }}" width="60" alt="Logo">
                        </a>
                    </div>
                    <h2 class="text-center">¡Bienvenid@!</h2>
                    <p class="mb-5 text-center" style="color: #74788d;">
                        Inicia sesión para continuar en {{ $ajuste->nombre ?? env('APP_NAME') }}
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label class="form-label m-0" for="email">Correo electrónico</label>
                        <div class="form-group position-relative has-icon-left mb-2">
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
                        <label class="form-label m-0" for="password">Contraseña</label>
                        <div class="form-group position-relative has-icon-left mb-2">
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
                        <p class="text-gray-600" style="margin-bottom: .3rem">
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

</html> --}}
