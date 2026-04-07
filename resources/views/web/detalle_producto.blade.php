@extends('layouts.web')

@section('content')

    <!-- Product Details Section -->
    <section id="product-details" class="product-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-4">
                <!-- Product Gallery -->
                <div class="col-lg-6 col-sm-12 col-12" data-aos="zoom-in" data-aos-delay="150">
                    <div class="product-gallery">
                        <div class="main-showcase">
                            <div class="image-zoom-container">
                                @php
                                    $imagen_producto = $producto->imagenes->first();
                                    $imagen = $imagen_producto->imagen ?? '';
                                @endphp
                                <img src="{{ asset('storage/' . $imagen) }}" alt="Product Main"
                                    class="img-fluid main-product-image drift-zoom" id="main-product-image"
                                    data-zoom="{{ asset('storage/' . $imagen) }}">

                                <div class="image-navigation">
                                    <button class="nav-arrow prev-image image-nav-btn prev-image" type="button">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button class="nav-arrow next-image image-nav-btn next-image" type="button">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="thumbnail-grid">
                            @foreach ($producto->imagenes as $index => $item)
                                <div class="thumbnail-wrapper thumbnail-item {{ $index === 0 ? 'active' : '' }}"
                                    data-image="{{ asset('storage/' . $item->imagen) }}">
                                    <img src="{{ asset('storage/' . $item->imagen) }}" alt="View {{ $index + 1 }}"
                                        class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                        <script>
                            document.querySelectorAll('.thumbnail-item').forEach(item => {
                                item.addEventListener('click', () => {
                                    document.getElementById('main-product-image').src = item.dataset.image;
                                    document.getElementById('main-product-image').setAttribute('data-zoom', item.dataset.image);
                                    document.querySelectorAll('.thumbnail-item').forEach(i => i.classList.remove('active'));
                                    item.classList.add('active');
                                });
                            });
                        </script>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-6 col-sm-12 col-12" data-aos="fade-left" data-aos-delay="200">
                    <div class="product-details">
                        <div class="product-badge-container">
                            <span class="badge-category">{{ $producto->categoria->nombre }}</span>
                            <div class="rating-group">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="review-text">(127 reseñas)</span>
                            </div>
                        </div>

                        <h1 class="product-name">{{ $producto->nombre }}</h1>

                        <div class="pricing-section">
                            <div class="price-display">
                                <span class="sale-price">{{ $ajuste->divisa . ' ' . number_format($producto->precio_venta, 2) }}</span>
                            </div>
                        </div>

                        <div class="product-description">
                            <p>{{ $producto->descripcion_corta }}</p>
                        </div>

                        <div class="availability-status">
                            <div class="stock-indicator">
                                <i class="bi bi-check-circle-fill"></i>
                                <span class="stock-text">En stock</span>
                            </div>
                            <div class="quantity-left">Solo {{ $producto->stock ?? '0' }} unidades disponibles</div>
                        </div>


                        <!-- Purchase Options -->
                        <div class="purchase-section">
                            <form action="{{ url('/carrito/agregar') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                                <div class="quantity-control">
                                    <label class="control-label">Cantidad:</label>
                                    <div class="quantity-input-group">
                                        <div class="quantity-selector">
                                            <button class="quantity-btn decrease" type="button">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="number" name="cantidad" class="quantity-input" value="1"
                                                min="1" max="{{ $producto->stock ?? '0' }}">
                                            <button class="quantity-btn increase" type="button">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="action-buttons">
                                    <button type="submit" class="btn primary-action w-100">
                                        <i class="bi bi-bag-plus"></i> Añadir al carrito
                                    </button>

                                    <button type="button" class="btn icon-action" title="Añadir a favoritos"
                                        onclick="document.getElementById('favorito-form-{{ $producto->id }}').submit()">
                                        <i class="bi bi-heart-fill"></i>
                                    </button>
                                </div>
                            </form>

                            <form id="favorito-form-{{ $producto->id }}" action="{{ url('/favoritos') }}" method="POST"
                                class="d-none">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            </form>
                        </div>

                        <!-- Benefits List -->
                        <div class="benefits-list">
                            <div class="benefit-item">
                                <i class="bi bi-truck"></i>
                                <span>Envío gratuito en pedidos superiores a {{ $ajuste->divisa . ' ' . number_format($producto->precio_venta * 3, 2) }}</span>
                            </div>
                            <div class="benefit-item">
                                <i class="bi bi-arrow-clockwise"></i>
                                <span>Devoluciones gratuitas hasta 45 días</span>
                            </div>
                            <div class="benefit-item">
                                <i class="bi bi-shield-check"></i>
                                <span>Garantía oficial de 2 años</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Tabs -->
            <div class="row mt-5" data-aos="fade-up" data-aos-delay="300">
                <div class="col-12">
                    <div class="info-tabs-container">
                        <nav class="tabs-navigation nav">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#ecommerce-product-details-5-overview" type="button">Descripción</button>
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#ecommerce-product-details-5-technical" type="button">Especificaciones</button>
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#ecommerce-product-details-5-customer-reviews" type="button">Reseñas (127)</button>
                        </nav>

                        <div class="tab-content">
                            <!-- Overview Tab -->
                            <div class="tab-pane fade show active" id="ecommerce-product-details-5-overview">
                                <div class="overview-content">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="package-contents">
                                                <h4>Acerca de {{ $producto->nombre }}</h4>
                                                <p>{!! $producto->descripcion_larga !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Technical Details Tab - AHORA PARA RELOJES -->
                            <div class="tab-pane fade" id="ecommerce-product-details-5-technical">
                                <div class="technical-content">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="tech-group">
                                                <h4>Movimiento</h4>
                                                <div class="spec-table">
                                                    <div class="spec-row">
                                                        <span class="spec-name">Tipo</span>
                                                        <span class="spec-value">Automático / Cuarzo</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Precisión</span>
                                                        <span class="spec-value">±5 seg/día</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Reserva de marcha</span>
                                                        <span class="spec-value">80 horas</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Calibre</span>
                                                        <span class="spec-value">Calibre V-802</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="tech-group">
                                                <h4>Caja y Cristal</h4>
                                                <div class="spec-table">
                                                    <div class="spec-row">
                                                        <span class="spec-name">Material</span>
                                                        <span class="spec-value">Acero inoxidable 316L</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Diámetro</span>
                                                        <span class="spec-value">40mm</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Cristal</span>
                                                        <span class="spec-value">Zafiro antirreflejante</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Resistencia al agua</span>
                                                        <span class="spec-value">10 ATM (100m)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="tech-group">
                                                <h4>Pulso y Correa</h4>
                                                <div class="spec-table">
                                                    <div class="spec-row">
                                                        <span class="spec-name">Material correa</span>
                                                        <span class="spec-value">Piel genuina / Acero</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Ancho de correa</span>
                                                        <span class="spec-value">20mm</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Cierre</span>
                                                        <span class="spec-value">Hebilla desplegable</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Longitud ajustable</span>
                                                        <span class="spec-value">145-210mm</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="tech-group">
                                                <h4>Características</h4>
                                                <div class="spec-table">
                                                    <div class="spec-row">
                                                        <span class="spec-name">Funciones</span>
                                                        <span class="spec-value">Fecha, Cronógrafo</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Esfera</span>
                                                        <span class="spec-value">Sunray con índices luminosos</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Garantía</span>
                                                        <span class="spec-value">3 años internacional</span>
                                                    </div>
                                                    <div class="spec-row">
                                                        <span class="spec-name">Incluye</span>
                                                        <span class="spec-value">Estuche de lujo</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Tab -->
                            <div class="tab-pane fade" id="ecommerce-product-details-5-customer-reviews">
                                <div class="reviews-content">
                                    <div class="reviews-header">
                                        <div class="rating-overview">
                                            <div class="average-score">
                                                <div class="score-display">4.6</div>
                                                <div class="score-stars">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-half"></i>
                                                </div>
                                                <div class="total-reviews">127 reseñas de clientes</div>
                                            </div>

                                            <div class="rating-distribution">
                                                <div class="rating-row">
                                                    <span class="stars-label">5★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: 68%;"></div>
                                                    </div>
                                                    <span class="count-label">86</span>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="stars-label">4★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: 22%;"></div>
                                                    </div>
                                                    <span class="count-label">28</span>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="stars-label">3★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: 6%;"></div>
                                                    </div>
                                                    <span class="count-label">8</span>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="stars-label">2★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: 3%;"></div>
                                                    </div>
                                                    <span class="count-label">4</span>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="stars-label">1★</span>
                                                    <div class="progress-container">
                                                        <div class="progress-fill" style="width: 1%;"></div>
                                                    </div>
                                                    <span class="count-label">1</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="write-review-cta">
                                            <h4>Comparte tu experiencia</h4>
                                            <p>Ayuda a otros a elegir el mejor reloj</p>
                                            <button class="btn review-btn">Escribir reseña</button>
                                        </div>
                                    </div>

                                    <div class="customer-reviews-list">
                                        <div class="review-card">
                                            <div class="reviewer-profile">
                                                <img src="assets/img/person/person-f-3.webp" alt="Customer"
                                                    class="profile-pic">
                                                <div class="profile-details">
                                                    <div class="customer-name">María González</div>
                                                    <div class="review-meta">
                                                        <div class="review-stars">
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                        </div>
                                                        <span class="review-date">28 marzo, 2024</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 class="review-headline">Elegante y preciso</h5>
                                            <div class="review-text">
                                                <p>Excelente reloj, el diseño es impecable y la precisión es sorprendente. Se ve muy elegante en la muñeca. Totalmente recomendado.</p>
                                            </div>
                                            <div class="review-actions">
                                                <button class="action-btn"><i class="bi bi-hand-thumbs-up"></i> Útil (12)</button>
                                                <button class="action-btn"><i class="bi bi-chat-dots"></i> Responder</button>
                                            </div>
                                        </div>

                                        <div class="review-card">
                                            <div class="reviewer-profile">
                                                <img src="assets/img/person/person-m-5.webp" alt="Customer"
                                                    class="profile-pic">
                                                <div class="profile-details">
                                                    <div class="customer-name">Carlos Ruiz</div>
                                                    <div class="review-meta">
                                                        <div class="review-stars">
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star"></i>
                                                        </div>
                                                        <span class="review-date">15 marzo, 2024</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 class="review-headline">Buena relación calidad-precio</h5>
                                            <div class="review-text">
                                                <p>Muy contento con la compra. La correa es cómoda y el mecanismo funciona perfectamente. Llegó en estuche muy bonito.</p>
                                            </div>
                                            <div class="review-actions">
                                                <button class="action-btn"><i class="bi bi-hand-thumbs-up"></i> Útil (8)</button>
                                                <button class="action-btn"><i class="bi bi-chat-dots"></i> Responder</button>
                                            </div>
                                        </div>

                                        <div class="review-card">
                                            <div class="reviewer-profile">
                                                <img src="assets/img/person/person-f-7.webp" alt="Customer"
                                                    class="profile-pic">
                                                <div class="profile-details">
                                                    <div class="customer-name">Laura Fernández</div>
                                                    <div class="review-meta">
                                                        <div class="review-stars">
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                            <i class="bi bi-star-fill"></i>
                                                        </div>
                                                        <span class="review-date">22 febrero, 2024</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 class="review-headline">Perfecto para regalar</h5>
                                            <div class="review-text">
                                                <p>Lo compré como regalo y fue todo un acierto. La presentación es espectacular y el reloj se ve de alta gama. Sin duda volveré a comprar.</p>
                                            </div>
                                            <div class="review-actions">
                                                <button class="action-btn"><i class="bi bi-hand-thumbs-up"></i> Útil (15)</button>
                                                <button class="action-btn"><i class="bi bi-chat-dots"></i> Responder</button>
                                            </div>
                                        </div>

                                        <div class="load-more-section">
                                            <button class="btn load-more-reviews">Ver más reseñas</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- /Product Details Section -->
@endsection

<style>
/* ============================================
   SOLO CAMBIOS DE COLOR - VELORUM RELOJES
   ============================================ */

/* Badge categoría */
.badge-category {
    background: var(--velorum-gold) !important;
    color: var(--velorum-text) !important;
}

/* Estrellas */
.stars i {
    color: var(--velorum-gold) !important;
}

/* Precio */
.sale-price {
    color: var(--velorum-gold) !important;
}

/* Stock */
.stock-indicator i {
    color: var(--velorum-gold) !important;
}

/* Botón principal */
.primary-action {
    background: var(--velorum-gold) !important;
    color: var(--velorum-text) !important;
    border: none !important;
}

.primary-action:hover {
    background: var(--velorum-gold-dark) !important;
}

/* Botón icono */
.icon-action {
    border-color: var(--velorum-gold) !important;
    color: var(--velorum-gold) !important;
}

.icon-action:hover {
    background: var(--velorum-gold) !important;
    color: var(--velorum-text) !important;
}

/* Benefits */
.benefit-item i {
    color: var(--velorum-gold) !important;
}

/* Tabs */
.tabs-navigation .nav-link.active {
    border-bottom-color: var(--velorum-gold) !important;
}

/* Progress fill reseñas */
.progress-fill {
    background: var(--velorum-gold) !important;
}

/* Botón reseña */
.review-btn {
    background: var(--velorum-gold) !important;
    color: var(--velorum-text) !important;
}

/* Thumbnail activo */
.thumbnail-item.active {
    border-color: var(--velorum-gold) !important;
}

/* Navegación imágenes */
.nav-arrow {
    background: var(--velorum-gold) !important;
    color: var(--velorum-text) !important;
}
</style>