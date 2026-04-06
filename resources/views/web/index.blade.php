@extends('layouts.web')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="hero-container">
            <div class="hero-content">
                <div class="content-wrapper" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="hero-title">Tiempos de Lujo</h1>
                    <p class="hero-description">Descubre nuestra colección de relojes de lujo, diseñados para los que valoran
                        la artesanía, la precisión y el estilo atemporal. Cada pieza cuenta una historia.</p>
                    <div class="hero-actions" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ url('/productos') }}" class="btn-primary">Ver Colección</a>
                        <a href="{{ url('/colecciones') }}" class="btn-secondary">Explorar Novedades</a>
                    </div>
                    <div class="features-list" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-item">
                            <i class="bi bi-gem"></i>
                            <span>Materiales Premium</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-shield-check"></i>
                            <span>Garantía Internacional</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-truck"></i>
                            <span>Envío Asegurado</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-visuals">
                <div class="product-showcase" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-card featured">
                        <img src="{{ 'storage/' . $mejor_producto->imagenes->first()->imagen ?? '' }}" alt="Featured Product" class="img-fluid">
                        <div class="product-badge">Mejor vendido</div>
                        <div class="product-info">
                            <h4>{{ $mejor_producto->nombre ?? 'Producto destacado' }}</h4>
                            <div class="price">
                                <span class="sale-price">{{ $ajuste->divisa . '. ' . $mejor_producto->precio_venta }}</span>
                                <span
                                    class="original-price">{{ $ajuste->divisa . ': ' . ($mejor_producto->precio_venta + 15) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="product-grid">
                        @foreach ($productos_destacados as $index => $producto)
                            @php
                                $foto = $producto->imagenes->first()->imagen ?? '';
                            @endphp

                            <div class="product-mini" data-aos="zoom-in" data-aos-delay="{{ 400 + $index * 100 }}">
                                <img src="{{ 'storage/' . $foto }}" alt="Product" class="img-fluid">
                                <span class="mini-price">
                                    {{ $ajuste->divisa . '. ' . $producto->precio_venta }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="floating-elements">
                    <div class="floating-icon cart" data-aos="fade-up" data-aos-delay="600">
                        <i class="bi bi-cart3"></i>
                        <span class="notification-dot">3</span>
                    </div>
                    <div class="floating-icon wishlist" data-aos="fade-up" data-aos-delay="700">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="floating-icon search" data-aos="fade-up" data-aos-delay="800">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Hero Section -->

    <!-- Best Sellers Section -->
    <section id="best-sellers" class="best-sellers section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Los más vendidos</h2>
            <p>Los productos más populares entre nuestros clientes</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-5">
                @foreach ($productos as $producto)
                    <!-- Product -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="product-image">
                                @php
                                    $imagen_producto = $producto->imagenes->first();
                                    $imagen = $imagen_producto->imagen ?? '';
                                @endphp
                                <img src="{{ asset('storage/' . $imagen) }}" alt="Product Image" class="img-fluid"
                                    loading="lazy">
                                <div class="product-actions">
                                    <form action="{{ url('/favoritos') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                        <button type="submit" class="action-btn wishlist-btn">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    </form>
                                    <a href="{{ url('/producto/' . $producto->id) }}" class="btn action-btn quickview-btn">
                                        <i class="bi bi-zoom-in"></i>
                                    </a>
                                </div>
                                <form action="{{ url('/carrito/agregar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                    <input type="hidden" name="cantidad" value="1">
                                    <button type="submit" class="cart-btn">Añadir al carrito</button>
                                </form>
                            </div>
                            <div class="product-info">
                                <div class="product-category">{{ $producto->nombre }} </div>
                                <h4 class="product-name"><a
                                        href="{{ url('/producto/' . $producto->id) }}">{{ $producto->descripcion_corta }}</a>
                                </h4>
                                <div class="product-rating">
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <span class="rating-count">(38)</span>
                                    <span class="badge bg-success">{{ $producto->stock }} disponibles</span>
                                </div>
                                <div class="product-price">
                                    <span
                                        class="current-price">{{ $ajuste->divisa . '. ' . $producto->precio_venta }}</span>
                                </div>
                                <div class="color-swatches">
                                    <span class="swatch active" style="background-color: #1f2937;"></span>
                                    <span class="swatch" style="background-color: #f59e0b;"></span>
                                    <span class="swatch" style="background-color: #8b5cf6;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Product -->
                @endforeach
                @if ($productos->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 px-3">
                        <div class="text-muted">
                            Mostrando {{ $productos->firstItem() }} a {{ $productos->lastItem() }} de
                            {{ $productos->total() }} productos
                        </div>
                        <div>
                            {{ $productos->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section><!-- /Best Sellers Section -->
@endsection

<style>
    /* ============================================
   SOLO CAMBIOS DE COLOR - VELORUM
   ============================================ */

    /* Hero Section */
    .hero-section .btn-primary,
    .btn-primary {
        background: var(--velorum-gold) !important;
        border-color: var(--velorum-gold) !important;
        color: var(--velorum-text) !important;
    }

    .hero-section .btn-primary:hover,
    .btn-primary:hover {
        background: var(--velorum-gold-dark) !important;
    }

    .btn-secondary {
        border-color: var(--velorum-gold) !important;
        color: var(--velorum-gold) !important;
    }

    .btn-secondary:hover {
        background: var(--velorum-gold) !important;
        color: var(--velorum-text) !important;
    }

    .feature-item i {
        color: var(--velorum-gold) !important;
    }

    .product-badge {
        background: var(--velorum-gold) !important;
        color: var(--velorum-text) !important;
    }

    .sale-price {
        color: var(--velorum-gold) !important;
    }

    .mini-price {
        color: var(--velorum-gold) !important;
    }

    /* Best Sellers Section */
    .section-title h2 {
        color: var(--velorum-text) !important;
    }

    .section-title p {
        color: var(--velorum-text-light) !important;
    }

    .product-item .product-category {
        color: var(--velorum-text-light) !important;
    }

    .product-item .product-name a {
        color: var(--velorum-text) !important;
    }

    .product-item .stars i {
        color: var(--velorum-gold) !important;
    }

    .product-item .current-price {
        color: var(--velorum-gold) !important;
    }

    .product-item .cart-btn {
        background: var(--velorum-gold) !important;
        color: var(--velorum-text-color) !important;
    }
    
    .product-item .cart-btn:hover {
        background: var(--velorum-gold-dark) !important;
        color: var(--velorum-surface) !important;
        border: 1px solid var(--velorum-gold) !important;
    }

    .action-btn:hover {
        background: var(--velorum-gold) !important;
    }

    .action-btn:hover i {
        color: var(--velorum-text) !important;
    }

    /* Badge stock */
    .badge.bg-success {
        background: var(--velorum-gold) !important;
        color: var(--velorum-text) !important;
    }

    /* Paginación */
    .pagination .page-item.active .page-link {
        background: var(--velorum-gold) !important;
        border-color: var(--velorum-gold) !important;
        color: var(--velorum-text) !important;
    }

    .pagination .page-link {
        color: var(--velorum-gold) !important;
    }

    /* Floating elements */
    .floating-icon {
        background: var(--velorum-surface) !important;
        color: var(--velorum-gold) !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .notification-dot {
        background: var(--velorum-gold) !important;
        color: var(--velorum-text) !important;
    }

    /* Swatches */
    .swatch.active {
        border: 2px solid var(--velorum-gold) !important;
    }

    /* Hacer que las imágenes se vean más lejanas */
    .product-item .product-image img {
        object-fit: contain !important;
        transform: scale(1.0) !important;
        transition: transform 0.3s ease;
    }

    .product-item:hover .product-image img {
        transform: scale(0.9) !important;
    }
</style>
