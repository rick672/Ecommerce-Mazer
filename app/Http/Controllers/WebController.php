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
        $productos = Producto::all();
        return view('web.index', compact('ajuste', 'productos'));
    }
}
