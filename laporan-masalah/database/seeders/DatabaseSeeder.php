<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MahasiswaSeeder::class,
        ]);

        $mahasiswa = \App\Models\Mahasiswa::factory()->create();
        User::factory()->create([
            'name' => $mahasiswa->nama,
            'email' => $mahasiswa->email,
            'role' => 'mahasiswa',
            'mahasiswa_id' => $mahasiswa->id,
        ]);

        $dosen = \App\Models\Dosen::factory()->create();
        User::factory()->create([
            'name' => $dosen->nama,
            'email' => $dosen->email,
            'role' => 'dpa',
            'dosen_id' => $dosen->id,
        ]);
    }
}
