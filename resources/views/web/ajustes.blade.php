@extends('layouts.web')

@section('content')
    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Ajustes</h1>
        </div>
    </div><!-- End Page Title -->

    <!-- Account Section -->
    <section id="account" class="account section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <!-- Mobile Menu Toggle -->
            <div class="mobile-menu d-lg-none mb-4">
                <button class="mobile-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#profileMenu">
                    <i class="bi bi-grid"></i>
                    <span>Menu</span>
                </button>
            </div>

            <div class="row g-4">
                <!-- Profile Menu -->
                <div class="col-lg-3">
                    <div class="profile-menu collapse d-lg-block" id="profileMenu">
                        <!-- User Info -->
                        <div class="user-info" data-aos="fade-right">
                            <div class="user-avatar">
                                <img src="{{ asset('storage/' . $ajuste->logo) }}" alt="Profile" loading="lazy">
                                <span class="status-badge"><i class="bi bi-shield-check"></i></span>
                            </div>
                            <h4>{{ Auth::user()->name ?? '' }}</h4>
                            <div class="user-status">
                                <i class="bi bi-award"></i>
                                <span>{{ Auth::user()->roles()->pluck('name')->implode(', ') }}</span>
                            </div>
                        </div>

                        <!-- Navigation Menu -->
                        <nav class="menu-nav">
                            <ul class="nav flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#orders">
                                        <i class="bi bi-gear"></i>
                                        <span>Ajustes</span>
                                    </a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="col-lg-9">
                    <div class="content-area">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="section-header" data-aos="fade-up">
                                    <h2>Ajustes de la cuenta</h2>
                                </div>

                                <div class="settings-content">
                                    <!-- Personal Information -->
                                    <div class="settings-section" data-aos="fade-up">
                                        <h3>Informacion Personal</h3>
                                        <form class="settings-form" action="{{ url('/ajustes/informacion_personal') }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="firstName" class="form-label">Nombre del usuario</label>
                                                    <input type="text" name="name" class="form-control" id="firstName"
                                                        value="{{ Auth::user()->name }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email"
                                                        value="{{ Auth::user()->email }}" required>
                                                </div>
                                            </div>

                                            <div class="form-buttons">
                                                <button type="submit" class="btn-save">Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Security Settings -->
                                    <div class="settings-section" data-aos="fade-up" data-aos-delay="200">
                                        <h3>Seguridad</h3>
                                        <form class="settings-form" action="{{ url('/ajustes/actualizar_password') }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="currentPassword" class="form-label">Contraseña
                                                        actual</label>
                                                    <input type="password" name="current_password" class="form-control"
                                                        id="currentPassword" required>
                                                    @error('current_password')
                                                        <div role="alert">
                                                            <small class="text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="newPassword" class="form-label">Nueva contraseña</label>
                                                    <input type="password" name="password" class="form-control"
                                                        id="newPassword" required>
                                                    @error('password')
                                                        <div role="alert">
                                                            <small class="text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="confirmPassword" class="form-label">Confirmar
                                                        contraseña</label>
                                                    <input type="password" name="password_confirmation" class="form-control"
                                                        id="confirmPassword" required>
                                                    @error('password_confirmation')
                                                        <div role="alert">
                                                            <small class="text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-buttons">
                                                <button type="submit" class="btn-save">Actualizar contraseña</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Delete Account -->
                                    <div class="settings-section danger-zone" data-aos="fade-up" data-aos-delay="300">
                                        <h3>Eliminar cuenta</h3>
                                        <div class="danger-zone-content">
                                            <p>Una vez que elimines tu cuenta, no hay vuelta atrás. Por favor, asegúrate.
                                            </p>
                                            <button type="button" class="btn-danger">Eliminar cuenta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Account Section -->
@endsection
