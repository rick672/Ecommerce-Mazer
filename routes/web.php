<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home')->middleware('auth');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('auth');

Route::get('/admin/ajustes', [App\Http\Controllers\AjusteController::class, 'index'])->name('admin.ajustes.index')->middleware('auth');
Route::post('/admin/ajustes/create', [App\Http\Controllers\AjusteController::class, 'store'])->name('admin.ajustes.store')->middleware('auth');
// Roles
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');
Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth');
Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/admin/rol/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('admin.roles.show')->middleware('auth');
Route::get('/admin/rol/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');
Route::put('/admin/rol/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/admin/rol/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');
// Usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth');
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuario/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');
Route::get('/admin/usuario/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::put('/admin/usuario/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/admin/usuario/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');
Route::post('/admin/usuario/{id}/restaurar', [App\Http\Controllers\UsuarioController::class, 'restore'])->name('admin.usuarios.restore')->middleware('auth');

// Categorias
Route::get('/admin/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('admin.categorias.index')->middleware('auth');
Route::get('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'create'])->name('admin.categorias.create')->middleware('auth');
Route::post('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'store'])->name('admin.categorias.store')->middleware('auth');
Route::get('/admin/categoria/{id}', [App\Http\Controllers\CategoriaController::class, 'show'])->name('admin.categorias.show')->middleware('auth');
Route::get('/admin/categoria/{id}/edit', [App\Http\Controllers\CategoriaController::class, 'edit'])->name('admin.categorias.edit')->middleware('auth');
Route::put('/admin/categoria/{id}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('admin.categorias.update')->middleware('auth');
Route::delete('/admin/categoria/{id}', [App\Http\Controllers\CategoriaController::class, 'destroy'])->name('admin.categorias.destroy')->middleware('auth');

// Productos
Route::get('/admin/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('admin.productos.index')->middleware('auth');
Route::get('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('admin.productos.create')->middleware('auth');
Route::post('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'store'])->name('admin.productos.store')->middleware('auth');
Route::get('/admin/producto/{id}', [App\Http\Controllers\ProductoController::class, 'show'])->name('admin.productos.show')->middleware('auth');
Route::get('/admin/producto/{id}/imagenes', [App\Http\Controllers\ProductoController::class, 'imagenes'])->name('admin.productos.imagenes')->middleware('auth');
Route::post('/admin/producto/{id}/upload_imagen', [App\Http\Controllers\ProductoController::class, 'upload_imagen'])->name('admin.productos.upload_imagen')->middleware('auth');
Route::delete('/admin/producto/imagen/{id}/destroy_imagen', [App\Http\Controllers\ProductoController::class, 'destroy_imagen'])->name('admin.productos.destroy_imagen')->middleware('auth');
Route::get('/admin/producto/{id}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('admin.productos.edit')->middleware('auth');
Route::put('/admin/producto/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('admin.productos.update')->middleware('auth');
Route::delete('/admin/producto/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('admin.productos.destroy')->middleware('auth');


// Rutas para la web
Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('web');
Route::get('/producto/{id}', [App\Http\Controllers\ProductoController::class, 'detalle_producto'])->name('web.detalle_producto');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('web.dashboard');
Route::get('/carrito', [App\Http\Controllers\DashboardController::class, 'carrito'])->name('web.carrito');
Route::get('/web/login', [App\Http\Controllers\DashboardController::class, 'login'])->name('web.login');
Route::post('/web/login', [App\Http\Controllers\DashboardController::class, 'authenticacion'])->name('web.authenticacion');
Route::get('/web/registro', [App\Http\Controllers\DashboardController::class, 'registro'])->name('web.registro');
Route::post('/web/registro', [App\Http\Controllers\DashboardController::class, 'crear_cuenta'])->name('web.crear_cuenta');
Route::get('/buscar', [App\Http\Controllers\WebController::class, 'buscar_producto'])->name('web.buscar_producto');
// Favoritos
Route::get('/favoritos', [App\Http\Controllers\ProductoFavoritoController::class, 'index'])->name('web.favoritos.index');
Route::post('/favoritos', [App\Http\Controllers\ProductoFavoritoController::class, 'store'])->name('web.favoritos.store');
Route::delete('/favorito/{id}', [App\Http\Controllers\ProductoFavoritoController::class, 'destroy'])->name('web.favoritos.destroy');
// Carrito
Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'index'])->name('web.carrito');
Route::post('/carrito/agregar', [App\Http\Controllers\CarritoController::class, 'store'])->name('web.carrito.store');
Route::put('/carrito/actualizar', [App\Http\Controllers\CarritoController::class, 'update'])->name('web.carrito.update');
Route::delete('/carrito/{id}', [App\Http\Controllers\CarritoController::class, 'destroy'])->name('web.carrito.destroy');
Route::post('/carrito/limpiar', [App\Http\Controllers\CarritoController::class, 'limpiar'])->name('web.carrito.limpiar');

// PayPal Routes
Route::post('/paypal/checkout', [App\Http\Controllers\PaypalController::class, 'checkout'])->name('web.paypal.checkout');
Route::get('/paypal/success', [App\Http\Controllers\PaypalController::class, 'success'])->name('web.paypal.success');
Route::get('/paypal/orden_completada', [App\Http\Controllers\PaypalController::class, 'orden_completada'])->name('web.paypal.orden_completada');
Route::get('/paypal/cancel', [App\Http\Controllers\PaypalController::class, 'cancel'])->name('web.paypal.cancel');







Route::fallback(function () {
    if (request()->is('admin*')) {
        return response()->view('errors.404-admin', [], 404);
    }
    return response()->view('errors.404', [], 404);
});
