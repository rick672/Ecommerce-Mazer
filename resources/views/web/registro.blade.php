@extends('layouts.web')

@section('content')
    <!-- Register Section -->
    <section id="register" class="register section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="registration-form-wrapper">
                        <div class="form-header text-center">
                            <h2>Crear tu cuenta</h2>
                            <p>Crea tu cuenta y empieza a comprar con nosotros</p>
                        </div>

                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <form action="{{ url('/web/registro') }}" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="fullName" name="name"
                                            placeholder="Nombre completo" required="" autocomplete="name">
                                        <label for="fullName">Nombre completo</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Correo electrónico" required="" autocomplete="email">
                                        <label for="email">Correo electrónico</label>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Contraseña" required="" minlength="8"
                                                    autocomplete="new-password">
                                                <label for="password">Contraseña</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="confirmPassword"
                                                    name="password_confirmation" placeholder="Confirmar contraseña" required=""
                                                    minlength="8" autocomplete="new-password">
                                                <label for="confirmPassword">Confirmar contraseña</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-register">Crear cuenta</button>
                                    </div>

                                    <div class="login-link text-center">
                                        <p>¿Ya tienes una cuenta? <a href="{{ url('/web/login') }}">Iniciar sesión</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="decorative-elements">
                            <div class="circle circle-1"></div>
                            <div class="circle circle-2"></div>
                            <div class="circle circle-3"></div>
                            <div class="square square-1"></div>
                            <div class="square square-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Register Section -->
@endsection
