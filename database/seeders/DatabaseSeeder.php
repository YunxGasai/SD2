<?php

namespace Database\Seeders;

use App\Models\Conference;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $roleClient = Role::where('name', 'client')->first();
        $roleEmployee = Role::where('name', 'employee')->first();
        $roleAdmin = Role::where('name', 'admin')->first();

        $u1 = User::create([
            'first_name' => 'Klientas',
            'last_name' => 'Pavyzdys',
            'email' => 'client@client',
            'password' => Hash::make('client'),
        ]);
        $u1->roles()->attach($roleClient->id);

        $u2 = User::create([
            'first_name' => 'Darbuotojas',
            'last_name' => 'Pavyzdys',
            'email' => 'employee@employee',
            'password' => Hash::make('employee'),
        ]);
        $u2->roles()->attach($roleEmployee->id);

        $u3 = User::create([
            'first_name' => 'Adminas',
            'last_name' => 'Pavyzdys',
            'email' => 'admin@admin',
            'password' => Hash::make('admin'),
        ]);
        $u3->roles()->attach($roleAdmin->id);

        Conference::create([
            'title' => 'Konferencijos pavadinimas 1',
            'description' => 'Trumpas aprašymas apie konferenciją nr. 1.',
            'lecturers' => 'Vardenis Pavardenis',
            'date' => '2026-06-10',
            'time' => '10:00',
            'address' => 'Adresas 12, Vilnius',
        ]);
        Conference::create([
            'title' => 'Konferencijos pavadinimas 2',
            'description' => 'Trumpas aprašymas apie konferenciją nr. 2.',
            'lecturers' => 'Antras Vardenis',
            'date' => '2025-03-01',
            'time' => '14:00',
            'address' => 'Gatvė 5, Kaunas',
        ]);
        Conference::create([
            'title' => 'Konferencijos pavadinimas 3',
            'description' => 'Trumpas aprašymas apie konferenciją nr. 3.',
            'lecturers' => 'Trečias Pavardenis',
            'date' => '2026-09-20',
            'time' => '09:30',
            'address' => 'Adresas 8, korpusas B',
        ]);
    }
}
