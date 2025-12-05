<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Producto;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $ajuste = Ajuste::first();
        $productos = Producto::paginate(8);
        return view('web.index', compact('ajuste', 'productos'));
    }

    public function buscar_producto(Request $request)
    {
        $ajuste = Ajuste::first();
        $query = $request->input('producto');
        $productos = Producto::where('nombre', 'like', '%'.$query.'%')
                                    ->orWhere('descripcion_corta', 'like', '%'.$query.'%')
                                    ->orderBy('nombre', 'asc')
                                    ->paginate(8);
        return view('web.buscar', compact('ajuste', 'productos', 'query'));
    }
}
