<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => '1. Tab Categoria']);
        Permission::create(['name' => '1.1 Crear Categoria']);
        Permission::create(['name' => '1.2 Editar Categoria']);
        Permission::create(['name' => '1.3 Eliminar Categoria']);

        //products
        Permission::create(['name' => '2. Tab Producto']);
        Permission::create(['name' => '2.1 Crear Producto']);
        Permission::create(['name' => '2.2 Editar Producto']);
        Permission::create(['name' => '2.3 Eliminar Producto']);

        //sales
        Permission::create(['name' => '3. Tab Ventas']);
        Permission::create(['name' => '3.1 Venta Denominaciones']);

        //roles
        Permission::create(['name' => '4. Tab Rol']);
        Permission::create(['name' => '4.1 Crear Rol']);
        Permission::create(['name' => '4.2 Editar Rol']);
        Permission::create(['name' => '4.3 Eliminar Rol']);

         //permissions
        Permission::create(['name' => '5. Tab Permiso']);
        Permission::create(['name' => '5.1 Crear Permiso']);
        Permission::create(['name' => '5.2 Editar Permiso']);
        Permission::create(['name' => '5.3 Eliminar Permiso']);

        //assign
        Permission::create(['name' => '6. Tab Asignar']);
        Permission::create(['name' => '6.1 Asignar Permisos']);
        Permission::create(['name' => '6.2 Revocar Permisos']);
        // Permission::create(['name' => '6.3 Check']);

        //users
        Permission::create(['name' => '7. Usuario']);
        Permission::create(['name' => '7.1 Crear Usuario']);
        Permission::create(['name' => '7.2 Actualizar Usuario']);
        Permission::create(['name' => '7.3 Eliminar usuario']);

        //cash out
        Permission::create(['name' => '8. Tab Moneda']);
        Permission::create(['name' => '8.1 Crear Moneda']);
        Permission::create(['name' => '8.2 Editar moneda']);
        Permission::create(['name' => '8.3 Eliminar moneda']);

        //denominations
        Permission::create(['name' => '9. Tab Cierre de Caja']);

        //reports
        Permission::create(['name' => '10. Reporte']);
        Permission::create(['name' => '10.1 Reporte Excel']);
        Permission::create(['name' => '10.2 Reporte Pdf']);

        //creación de roles
        $Administrador    = Role::create(['name' => 'Administrador']);

        //asignar permisos al role Admin
        $Administrador->givePermissionTo([
            '1. Tab Categoria',
            '1.1 Crear Categoria',
            '1.2 Editar Categoria',
            '1.3 Eliminar Categoria',
            '2. Tab Producto',
            '2.1 Crear Producto',
            '2.2 Editar Producto',
            '2.3 Eliminar Producto',
            '3. Tab Ventas',
            '3.1 Venta Denominaciones',
            '4. Tab Rol',
            '4.1 Crear Rol',
            '4.2 Editar Rol',
            '4.3 Eliminar Rol',
            '5. Tab Permiso',
            '5.1 Crear Permiso',
            '5.2 Editar Permiso',
            '5.3 Eliminar Permiso',
            '6. Tab Asignar',
            '6.1 Asignar Permisos',
            '6.2 Revocar Permisos',
            '7. Usuario',
            '7.1 Crear Usuario',
            '7.2 Actualizar Usuario',
            '7.3 Eliminar usuario',
            '8. Tab Moneda',
            '8.1 Crear Moneda',
            '8.2 Editar moneda',
            '8.3 Eliminar moneda',
            '9. Tab Cierre de Caja',
            '10. Reporte',
            '10.1 Reporte Excel',
            '10.2 Reporte Pdf'
        ]);

        //asignar rol al usuario admin
        $uAdmin = User::find(1);
        $uAdmin->assignRole('Administrador');
    }
}
