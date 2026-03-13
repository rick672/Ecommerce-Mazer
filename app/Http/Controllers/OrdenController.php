<?php

namespace App\Http\Controllers;

use App\Mail\PedidoEnviadoMail;
use App\Models\Ajuste;
use App\Models\Orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');
        $query = Orden::with('usuario', 'detalles.producto')->orderBy('created_at', 'desc');
        // return response()->json($ordenes);
        if ($buscar) {
            $query->where(function ($q) use ($buscar) {

                $q->whereHas('usuario', function ($userQuery) use ($buscar) {
                    $userQuery->where('name', 'like', '%' . $buscar . '%')
                                ->orWhere('email', 'like', '%' . $buscar . '%');
                });
                $q->orWhereHas('detalles.producto', function ($productoQuery) use ($buscar) {
                    $productoQuery->where('nombre', 'like', '%' . $buscar . '%');
                });
            });
        }

        $pedidos = $query->paginate(5);
        return view('admin.pedidos.index', compact('pedidos', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $pedido = Orden::with('detalles')->findOrFail($id);
        return view('admin.pedidos.create', compact('pedido'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // return response()->json($request->all());
        $orden = Orden::findOrFail($id);
        $ajuste = Ajuste::first();

        $request->validate([
            'nota' => 'required',
        ]);
        $orden->nota = $request->nota;
        $orden->estado_orden = 'Enviado';
        $orden->save();

        Mail::to($orden->usuario->email)->send(new PedidoEnviadoMail($orden, $ajuste));

        return redirect()->route('admin.pedidos.index')
            ->with('message', 'Pedido tomado correctamente')
            ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orden $orden)
    {
        //
    }
}
