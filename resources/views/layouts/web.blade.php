@php
    $ajuste = \App\Models\Ajuste::first() ?? '';
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $ajuste->nombre ?? ENV('APP_NAME') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('storage/' . $ajuste->logo) }}" rel="icon">
    <link href="{{ asset('storage/' . $ajuste->logo) }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('/assets/css/main.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- =======================================================
  * Template Name: NiceShop
  * Template URL: https://bootstrapmade.com/niceshop-bootstrap-ecommerce-template/
  * Updated: Aug 26 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <style>
        /* ============================================
       PALETA DE COLORES VELORUM - UNIFICADA
    ============================================ */
        :root {
            --velorum-bg: #FAFAFA;
            --velorum-surface: #FFFFFF;
            --velorum-gold: #D4AF37;
            --velorum-gold-dark: #B8960C;
            --velorum-text: #1E1E1E;
            --velorum-text-light: #6C6C6C;
            --velorum-border: #EAEAEA;
            --velorum-dark: #1A1A1A;
            --velorum-footer-text: #B0B0B0;
        }

        /* Fondo general */
        body {
            background: var(--velorum-bg);
            color: var(--velorum-text);
        }

        /* ========== HEADER ========== */
        .header {
            background: var(--velorum-surface);
            border-bottom: 1px solid var(--velorum-border);
        }

        .header .sitename {
            color: var(--velorum-text);
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Navegación */
        .header .header-nav {
            background: var(--velorum-surface) !important;
            border-top: 1px solid var(--velorum-border);
        }

        .navmenu ul li a {
            color: var(--velorum-text);
        }

        .navmenu ul li a:hover,
        .navmenu ul li a.active {
            color: var(--velorum-gold);
        }

        /* Botones de acción del header */
        .header-action-btn {
            color: var(--velorum-text) !important;
        }

        .header-action-btn:hover {
            color: var(--velorum-gold) !important;
        }

        .header-action-btn .badge {
            background: var(--velorum-gold) !important;
            color: var(--velorum-text) !important;
        }

        /* Buscador */
        .search-form .form-control {
            border-color: var(--velorum-border) !important;
            background: var(--velorum-surface);
            color: var(--velorum-text) !important;
        }

        .search-form .form-control:focus {
            border-color: var(--velorum-gold) !important;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1) !important;
        }

        .search-form .btn {
            background-color: var(--velorum-gold) !important;
            color: var(--velorum-surface) !important;
        }
        
        .search-form .btn:hover {
            background: var(--velorum-gold-dark) !important;
            color: var(--velorum-text) !important;
        }

        /* Dropdown */
        .dropdown-menu {
            background-color: var(--velorum-surface) !important;
            border: 1px solid var(--velorum-border) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .dropdown-header {
            border-bottom-color: var(--velorum-border);
        }

        .dropdown-item {
            color: var(--velorum-text) !important;
        }

        .dropdown-item:hover {
            background-color: var(--velorum-bg) !important;
            color: var(--velorum-gold-dark) !important;
        }

        /* ========== FOOTER ========== */
        .footer {
            background: var(--velorum-dark) !important;
            color: var(--velorum-footer-text) !important;
        }

        .footer .sitename {
            color: var(--velorum-gold) !important;
        }

        .footer h4 {
            color: var(--velorum-gold) !important;
        }

        .footer p {
            color: var(--velorum-footer-text) !important;
        }

        .footer a {
            color: var(--velorum-footer-text) !important;
            transition: color 0.2s;
        }

        .footer a:hover {
            color: var(--velorum-gold) !important;
        }

        .footer .social-icons a:hover {
            color: var(--velorum-gold) !important;
        }

        .footer .contact-item i {
            color: var(--velorum-gold) !important;
        }
        
        .footer .contact-item span {
            color: var(--velorum-footer-text) !important;
        }

        .footer-bottom {
            border-top-color: rgba(255, 255, 255, 0.1) !important;
        }

        .footer-bottom strong {
            color: var(--velorum-gold) !important;
        }

        /* ========== BOTONES GENERALES ========== */
        .btn-primary {
            background: var(--velorum-gold) !important;
            border: none !important;
            color: var(--velorum-text) !important;
        }

        .btn-primary:hover {
            background: var(--velorum-gold-dark) !important;
        }

        .btn-outline-primary {
            border-color: var(--velorum-gold) !important;
            color: var(--velorum-gold) !important;
        }

        .btn-outline-primary:hover {
            background: var(--velorum-gold) !important;
            color: var(--velorum-text) !important;
        }

        /* ========== ENLACES ========== */
        a {
            color: var(--velorum-text);
            text-decoration: none;
        }

        a:hover {
            color: var(--velorum-gold);
        }

        /* ========== BORDES Y TARJETAS ========== */
        .card,
        .product-card {
            background: var(--velorum-surface);
            border-color: var(--velorum-border);
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .header .sitename {
                font-size: 1.2rem;
            }

            .header-action-btn span.d-none.d-md-inline {
                display: none !important;
            }

            .header-action-btn i {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header sticky-top">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Header -->
        <div class="main-header">
            <div class="container-fluid container-xl">
                <div class="d-flex py-3 align-items-center justify-content-between">

                    <!-- Logo - Siempre muestra el nombre -->
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                        <h1 class="sitename">{{ $ajuste->nombre ?? env('APP_NAME') }}</h1>
                    </a>

                    <!-- Search -->
                    <form class="search-form desktop-search-form" method="GET" action="{{ url('/buscar') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="producto" placeholder="Buscar producto ..."
                                value="{{ $query ?? '' }}">
                            <button class="btn" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Actions -->
                    <div class="header-actions d-flex align-items-center justify-content-end">

                        <!-- Mobile Search Toggle -->
                        <button class="header-action-btn mobile-search-toggle d-xl-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false"
                            aria-controls="mobileSearch">
                            <i class="bi bi-search"></i>
                        </button>

                        <!-- Account Dropdown -->
                        <div class="dropdown account-dropdown">
                            <button class="header-action-btn" data-bs-toggle="dropdown">
                                <i class="bi bi-person"></i>
                                <span class="d-none d-md-inline">{{ Auth::user()->name ?? '' }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">
                                    <h6>Bienvenid@ a <span
                                            class="sitename">{{ $ajuste->nombre ?? env('APP_NAME') }}</span></h6>
                                    <p class="mb-0">
                                        {{ Auth::user()->email ?? 'Acceder a la cuenta y gestionar tus pedidos.' }}
                                    </p>
                                </div>
                                <div class="dropdown-body">
                                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/dashboard') }}">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <span>Mi Perfil</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/dashboard') }}">
                                        <i class="bi bi-bag-check me-2"></i>
                                        <span>Mis Pedidos</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/favoritos') }}">
                                        <i class="bi bi-heart me-2"></i>
                                        <span>Mis favoritos</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/ajustes') }}">
                                        <i class="bi bi-gear me-2"></i>
                                        <span>Ajustes</span>
                                    </a>
                                </div>
                                <div class="dropdown-footer">
                                    @if (Auth::check())
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="bi bi-box-arrow-right"></i>
                                                Cerrar Sesión
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Iniciar
                                            Sesión</a>
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Crear
                                            Cuenta</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <a href="{{ url('/favoritos') }}" class="header-action-btn d-none d-md-block">
                            <i class="bi bi-heart"></i>
                            @php
                                $cantidad_favoritos = Auth::check()
                                    ? \App\Models\ProductoFavorito::where('usuario_id', Auth::user()->id)->count()
                                    : 0;
                            @endphp
                            <span class="badge">{{ $cantidad_favoritos }}</span>
                        </a>

                        <!-- Cart -->
                        <a href="{{ url('/carrito') }}" class="header-action-btn">
                            <i class="bi bi-cart3"></i>
                            @php
                                $cantidad_carrito = Auth::check()
                                    ? \App\Models\Carrito::where('usuario_id', Auth::user()->id)->count()
                                    : 0;
                            @endphp
                            <span class="badge">{{ $cantidad_carrito }}</span>
                        </a>

                        <!-- Mobile Navigation Toggle -->
                        <i class="mobile-nav-toggle d-xl-none bi bi-list me-0"></i>

                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="header-nav">
            <div class="container-fluid container-xl position-relative">
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{ url('/') }}" class="active">Inicio</a></li>
                        <li><a href="{{ url('/productos') }}">Relojes</a></li>
                        <li><a href="{{ url('/colecciones') }}">Colecciones</a></li>
                        <li><a href="{{ url('/novedades') }}">Novedades</a></li>
                        <li><a href="{{ url('/contacto') }}">Contacto</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Mobile Search Form -->
        <div class="collapse" id="mobileSearch">
            <div class="container">
                <form class="search-form" method="GET" action="{{ url('/buscar') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" name="producto" placeholder="Buscar productos">
                        <button class="btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </header>

    <main class="main">

        @yield('content')

    </main>

    <footer id="footer" class="footer">
        <div class="footer-main">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget footer-about">
                            <a href="{{ url('/') }}" class="logo">
                                @if ($ajuste && $ajuste->logo)
                                    <img src="{{ asset('storage/' . $ajuste->logo) }}" alt="VELORUM"
                                        style="height: 50px; margin-bottom: 1rem;">
                                @endif
                                <span class="sitename m-2">{{ $ajuste->nombre ?? env('APP_NAME') }}</span>
                            </a>
                            <p>{{ $ajuste->descripcion ?? 'Relojes de lujo con diseño atemporal. Precisión y elegancia en cada movimiento.' }}
                            </p>

                            <div class="social-links mt-4">
                                <h5 class="text-white">Síguenos</h5>
                                <div class="social-icons">
                                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>Relojes</h4>
                            <ul class="footer-links">
                                <li><a href="{{ url('/productos') }}">Novedades</a></li>
                                <li><a href="{{ url('/productos') }}">Colección Premium</a></li>
                                <li><a href="{{ url('/productos') }}">Edición Limitada</a></li>
                                <li><a href="{{ url('/productos') }}">Relojes Deportivos</a></li>
                                <li><a href="{{ url('/productos') }}">Clásicos</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>Soporte</h4>
                            <ul class="footer-links">
                                <li><a href="#">Centro de Ayuda</a></li>
                                <li><a href="#">Estado de Pedido</a></li>
                                <li><a href="#">Envíos y Garantía</a></li>
                                <li><a href="#">Devoluciones</a></li>
                                <li><a href="#">Mantenimiento</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget">
                            <h4>Contacto</h4>
                            <div class="footer-contact">
                                <div class="contact-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>Av. Relojera 123, Ciudad</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-telephone"></i>
                                    <span>+1 (555) 123-4567</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    <span>info@velorum.com</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-clock"></i>
                                    <span>Lun-Vie: 9am-6pm<br>Sáb: 10am-2pm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row gy-3 align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="copyright">
                            <p>© <span>Copyright</span> <strong
                                    class="sitename">{{ $ajuste->nombre ?? env('APP_NAME') }}</strong>. Todos los
                                derechos reservados</p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div
                            class="d-flex flex-wrap justify-content-lg-end justify-content-center align-items-center gap-4">
                            <div class="payment-methods">
                                <div class="payment-icons">
                                    <i class="bi bi-credit-card" aria-label="Credit Card"></i>
                                    <i class="bi bi-paypal" aria-label="PayPal"></i>
                                    <i class="bi bi-apple" aria-label="Apple Pay"></i>
                                    <i class="bi bi-google" aria-label="Google Pay"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"
        style="background: #D4AF37; color: #1A1A1A;">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/drift-zoom/Drift.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('/assets/js/main.js') }}"></script>

    @if (($mensaje = Session::get('message')) && ($icono = Session::get('icon')))
        <script>
            @php
                $tiempos = [
                    'success' => 1500,
                    'error' => 3000,
                    'warning' => 2500,
                    'info' => 3500,
                ];
                $timer = $tiempos[$icono] ?? 2000;
            @endphp
            Swal.fire({
                position: "center",
                icon: "{{ $icono }}",
                title: "{{ $mensaje }}",
                showConfirmButton: false,
                timer: {{ $timer }}
            });
        </script>
    @endif

</body>

</html>
