<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run() {
        // Crear permisos
        $permisos = [
            'ver_pacientes',
            'crear_pacientes',
            'editar_pacientes',
            'eliminar_pacientes'
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['nombre' => $permiso]);
        }

        // Crear roles
        $admin     = Role::create(['nombre' => 'admin']);
        $medico    = Role::create(['nombre' => 'medico']);
        $recepcion = Role::create(['nombre' => 'recepcion']);

        // Admin → todos los permisos
        $admin->permissions()->attach(Permission::all());

        // Médico → ver y editar
        $medico->permissions()->attach(
            Permission::whereIn('nombre', ['ver_pacientes', 'editar_pacientes'])->get()
        );

        // Recepción → ver y crear
        $recepcion->permissions()->attach(
            Permission::whereIn('nombre', ['ver_pacientes', 'crear_pacientes'])->get()
        );
    }
}