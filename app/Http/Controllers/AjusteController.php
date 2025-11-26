<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class AjusteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajuste = Ajuste::first();
        try {
            $jsonData = @file_get_contents('https://api.hilariweb.com/divisas');

            if ($jsonData === false) {
                // No hay internet o API caída
                $divisas = null;
            } else {
                $divisas = json_decode($jsonData, true);
            }

        } catch (\Throwable $th) {
            // Cualquier error inesperado
            $divisas = null;
        }
        return view('admin.ajustes.index', compact('divisas', 'ajuste'));
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
        // return response()->json($request->all());
        $ajuste = Ajuste::first();
        $rules =[
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'sucursal' => 'required|string|max:255',
            'direccion' => 'required|string',
            'telefonos' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'divisa' => 'required|string|max:20',
            'pagina_web' => 'nullable|url',
        ];

        if($ajuste){
            $rules['logo'] = 'nullable|image|mimes:jpeg,png,jpg,svg,gif';
            $rules['imagen_login'] = 'nullable|image|mimes:jpeg,png,jpg,svg,gif';
        }else{
            $rules['logo'] = 'required|image|mimes:jpeg,png,jpg,svg,gif';
            $rules['imagen_login'] = 'required|image|mimes:jpeg,png,jpg,svg,gif';
        }

        $request->validate($rules);

        if(!$ajuste){
            $ajuste = new Ajuste();
        }

        $ajuste->nombre = $request->nombre;
        $ajuste->descripcion = $request->descripcion;
        $ajuste->sucursal = $request->sucursal;
        $ajuste->direccion = $request->direccion;
        $ajuste->telefono = $request->telefonos;
        $ajuste->email = $request->email;
        $ajuste->divisa = $request->divisa;
        $ajuste->pagina_web = $request->pagina_web;

        if($request->hasFile('logo')){
            if($ajuste->logo && Storage::disk('public')->exists($ajuste->logo)){
                Storage::disk('public')->delete($ajuste->logo);
            }
            $ajuste->logo = $request->file('logo')->store('logos', 'public');
        }
        if($request->hasFile('imagen_login')){
            if($ajuste->imagen_login && Storage::disk('public')->exists($ajuste->imagen_login)){
                Storage::disk('public')->delete($ajuste->imagen_login);
            }
            $ajuste->imagen_login = $request->file('imagen_login')->store('imagenes_login', 'public');
        }

        $ajuste->save();

        echo 'Datos guardados';

        // return redirect()->route('admin.ajustes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ajuste $ajuste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ajuste $ajuste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ajuste $ajuste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ajuste $ajuste)
    {
        //
    }
}
