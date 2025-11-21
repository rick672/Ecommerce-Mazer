<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class AjusteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        return view('admin.ajustes.index', compact('divisas'));
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
        //
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
