<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $superAdmin = Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Vendedor']);
        Role::create(['name' => 'Cliente']);

        Permission::create(['name' => 'Dashboard del Administrador'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Ajustes del Sistema'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Actualizar Ajustes del Sistema'])->syncRoles($superAdmin);

        // Roles
        Permission::create(['name' => 'Listado de Roles'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Crear Rol'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Guardar Rol'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Detalles de Rol'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Editar Rol'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Detalles de Permisos de Rol'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Actualizar Permisos de Rol'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Actualizar Rol'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Eliminar Rol'])->syncRoles($superAdmin);

        // Users
        Permission::create(['name' => 'Listado de Usuarios'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Crear Usuario'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Guardar Usuario'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Detalles de Usuario'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Editar Usuario'])->syncRoles($superAdmin);        
        Permission::create(['name' => 'Actualizar Usuario'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Eliminar Usuario'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Restaurar Usuario'])->syncRoles($superAdmin);

        // Categorias
        Permission::create(['name' => 'Listado de Categorias'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Crear Categoria'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Guardar Categoria'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Detalles de Categoria'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Editar Categoria'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Actualizar Categoria'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Eliminar Categoria'])->syncRoles($superAdmin);

        // Productos
        Permission::create(['name' => 'Listado de Productos'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Crear Producto'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Guardar Producto'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Detalles de Producto']);
        Permission::create(['name' => 'Gestionar Imagenes de Producto'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Subir Imagenes de Producto'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Eliminar Imagenes de Producto'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Editar Producto'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Actualizar Producto'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Eliminar Producto'])->syncRoles($superAdmin);

        // Pedidos
        Permission::create(['name' => 'Listado de Pedidos'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Crear Pedido'])->syncRoles($superAdmin);
        Permission::create(['name' => 'Procesar Pedido'])->syncRoles($superAdmin);
    }
}
