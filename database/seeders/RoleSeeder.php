<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrador',
                'slug' => 'administrador',
                'description' => 'Acceso total al sistema.',
                'is_active' => true,
            ],
            [
                'name' => 'Coordinador',
                'slug' => 'coordinador',
                'description' => 'Gestiona módulos operativos y académicos.',
                'is_active' => true,
            ],
            [
                'name' => 'Maestro',
                'slug' => 'maestro',
                'description' => 'Acceso a clases, asistencia y seguimiento académico.',
                'is_active' => true,
            ],
            [
                'name' => 'Alumno',
                'slug' => 'alumno',
                'description' => 'Acceso a información académica personal.',
                'is_active' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']],
                $role
            );
        }
    }
}
