<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Orden;
use App\Models\Producto;
use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $total_roles = Role::count();
        $total_usuarios = User::whereDoesntHave('roles', function ($query){
            $query->where('name', 'Super Admin');
        } )->count();
        $total_categorias = Categoria::count();
        $total_productos = Producto::count();

        $total_pedidos_nuevos = Orden::where('estado_orden', 'Procesando')->count();
        $total_pedidos_enviados = Orden::where('estado_orden', 'Enviado')->count();
        $total_pedidos = Orden::count();

        // Charts
        // Clientes registrados por mes
        $usuarios_mensuales = User::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('COUNT(*) as total')
        )->groupBy('mes')
        ->orderBy('mes')
        ->get()
        ->toArray();

        $usuarios_data = array_fill(1, 12, 0);

        foreach ($usuarios_mensuales as $usuario) {
            $usuarios_data[$usuario['mes']] = $usuario['total'];
        }
        
        // Pedidos por mes
        $ordenes_mensuales = Orden::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('SUM(total) as total_monto')
        )->groupBy('mes')
        ->orderBy('mes')
        ->get()
        ->toArray();

        $ordenes_data = array_fill(1, 12, 0);

        foreach ($ordenes_mensuales as $orden) {
            $ordenes_data[$orden['mes']] = $orden['total_monto'];
        }

        // Productos con stock bajo y alto
        $limiteStockBajo = 10;
        $limiteStockAlto = 30;

        $stockBajo = Producto::where('stock', '<=', $limiteStockBajo)->count();
        $porcentajeStockBajo = $total_productos > 0 ? round(($stockBajo / $total_productos) * 100) : 0;

        $stockAlto = Producto::where('stock', '>=', $limiteStockAlto)->count();
        $porcentajeStockAlto = $total_productos > 0 ? round(($stockAlto / $total_productos) * 100) : 0;

        // print_r($usuarios_data);
        return view('admin.index', compact('total_roles', 'total_usuarios', 'total_categorias', 'total_productos', 'total_pedidos_nuevos', 'total_pedidos_enviados', 'total_pedidos', 'usuarios_data', 'ordenes_data', 'porcentajeStockBajo', 'porcentajeStockAlto'));
    }
}
