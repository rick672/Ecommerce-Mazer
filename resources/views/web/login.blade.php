@extends('layouts.web')

@section('content')
    <!-- Login Section -->
    <style>
        .auth-form {
            display: none;
            transition: .3s ease;
        }

        .auth-form.active {
            display: block;
        }

    </style>
    <section id="login" class="login section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="auth-container" data-aos="fade-in" data-aos-delay="200">

                        <!-- Login Form -->
                        <div class="auth-form login-form active">
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
                                    <button type="button" class="switch-btn" data-target="register">Crear cuenta</button>
                                </div>
                            </form>
                        </div>

                        <!-- Register Form -->
                        <div class="auth-form register-form">
                            <div class="form-header">
                                <h3>Crear Cuenta</h3>
                                <p>Únete a nosotros hoy y comienza</p>
                            </div>

                            <form class="auth-form-content">
                                <div class="name-row m-0">
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="bi bi-person"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="First name" required=""
                                            autocomplete="given-name">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="bi bi-person"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Last name" required=""
                                            autocomplete="family-name">
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-icon">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" placeholder="Email address" required=""
                                        autocomplete="email">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-icon">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="Create password" required=""
                                        autocomplete="new-password">
                                    <span class="password-toggle">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-icon">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="Confirm password"
                                        required="" autocomplete="new-password">
                                    <span class="password-toggle">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>

                                <div class="terms-check mb-4">
                                    <input type="checkbox" id="termsRegister" required="">
                                    <label for="termsRegister">
                                        I agree to the <a href="#">Terms of Service</a> and <a
                                            href="#">Privacy Policy</a>
                                    </label>
                                </div>

                                <button type="submit" class="auth-btn primary-btn mb-3">
                                    Create Account
                                    <i class="bi bi-arrow-right"></i>
                                </button>

                                <div class="switch-form">
                                    <span>Already have an account?</span>
                                    <button type="button" class="switch-btn" data-target="login">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Login Section -->
    <script>
        document.querySelectorAll('.switch-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-target'); // "login" o "register"

                // Formularios
                const loginForm = document.querySelector('.login-form');
                const registerForm = document.querySelector('.register-form');

                // Reset clases
                loginForm.classList.remove('active');
                registerForm.classList.remove('active');

                // Activar el correspondiente
                if (target === 'login') {
                    loginForm.classList.add('active');
                } else {
                    registerForm.classList.add('active');
                }
            });
        });
    </script>

@endsection
