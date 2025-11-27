<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(5);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30|unique:roles,name',
        ]);

        $rol = new Role();
        $rol->name = ucfirst(strtolower($request->name));
        $rol->save();

        return redirect()->route('admin.roles.index')
                        ->with('message', 'Rol creado exitosamente !!!')
                        ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rol = Role::find($id);
        return view('admin.roles.show', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rol = Role::find($id);
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:30|unique:roles,name,'.$id,
        ]);
        $rol = Role::find($id);
        $rol->name = ucfirst(strtolower($request->name));
        $rol->save();

        return redirect()->route('admin.roles.index')
                        ->with('message', 'Rol actualizado exitosamente !!!')
                        ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Role::find($id);
        $rol->delete();

        return redirect()->route('admin.roles.index')
                        ->with('message', 'Rol eliminado exitosamente !!!')
                        ->with('icon', 'success');
    }
}
