@extends('layouts.web')

@section('content')
    <!-- Login Section -->
    <style>
        .auth-form {
            display: none;
        }

        .auth-form.login-form {
            display: block;
        }

    </style>
    <section id="login" class="login section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="auth-container" data-aos="fade-in" data-aos-delay="200">

                        <!-- Login Form -->
                        <div class="auth-form login-form">
                            <div class="form-header">
                                <h3>Bienvenid@</h3>
                                <p>Inicia sesión en tu cuenta</p>
                            </div>

                            <form class="auth-form-content" action="{{ url('/web/login') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-icon">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input 
                                        type="email" class="form-control" 
                                        name="email"
                                        placeholder="Correo electrónico" 
                                        required=""
                                        autocomplete="email"
                                    >
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-icon">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input 
                                        type="password" class="form-control" 
                                        name="password"
                                        placeholder="Contraseña" 
                                        required=""
                                        autocomplete="current-password"
                                    >
                                    <span class="password-toggle">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>

                                <div class="form-options mb-4">
                                    <div class="remember-me">
                                        <input type="checkbox" id="rememberLogin">
                                        <label for="rememberLogin">Recuerdame</label>
                                    </div>
                                    <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                                </div>

                                <button type="submit" class="auth-btn primary-btn mb-3">
                                    Iniciar Sesión
                                    <i class="bi bi-arrow-right"></i>
                                </button>

                                <div class="switch-form">
                                    <span>¿No tienes una cuenta?</span>
                                    <a href="{{ url('/web/registro') }}" type="button" data-target="register"
                                            class="switch-btn">Crear Cuenta</a>
                                    {{-- <button type="button" class="switch-btn" data-target="register">Crear cuenta</button> --}}
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Login Section -->

@endsection
