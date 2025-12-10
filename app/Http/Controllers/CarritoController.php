<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guest()) {
            return redirect()->route('web.login')
                ->with('message', 'Debes iniciar sesión para ver tus productos favoritos')
                ->with('icon', 'warning');
        }
        $ajuste = Ajuste::first() ?? '';
        $carritos = Carrito::where('usuario_id', Auth::user()->id)
            ->with('producto.imagenes')
            ->get();
        return view('web.carritos', compact('carritos', 'ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $carrito_existe = Carrito::where('usuario_id', Auth::user()->id)
            ->where('producto_id', $request->producto_id)
            ->first();

        if ($carrito_existe) {
            $carrito_existe->cantidad += $request->cantidad;
            $carrito_existe->save();

            // AÑADIR ESTA LÍNEA - Redirigir también cuando actualiza
            return redirect()->route('web.carrito')
                ->with('message', 'Cantidad actualizada en el carrito')
                ->with('icon', 'info');
        } else {
            Carrito::create([
                'usuario_id' => Auth::user()->id,
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
            ]);

            return redirect()->route('web.carrito')
                ->with('message', 'Producto agregado al carrito')
                ->with('icon', 'success');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrito $carrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrito $carrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrito $carrito)
    {
        //
    }
}
