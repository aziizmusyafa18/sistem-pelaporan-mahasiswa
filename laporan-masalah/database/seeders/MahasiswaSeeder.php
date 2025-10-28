<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Mahasiswa::truncate();
        Schema::enableForeignKeyConstraints();

        $mahasiswas = [
            ['nama' => 'Budi Santoso', 'nim' => '1234567890', 'email' => 'budi.santoso@example.com'],
            ['nama' => 'Ani Yudhoyono', 'nim' => '1234567891', 'email' => 'ani.yudhoyono@example.com'],
            ['nama' => 'Citra Lestari', 'nim' => '1234567892', 'email' => 'citra.lestari@example.com'],
            ['nama' => 'Dewi Sartika', 'nim' => '1234567893', 'email' => 'dewi.sartika@example.com'],
            ['nama' => 'Eko Prasetyo', 'nim' => '1234567894', 'email' => 'eko.prasetyo@example.com'],
            ['nama' => 'Fitriani', 'nim' => '1234567895', 'email' => 'fitriani@example.com'],
            ['nama' => 'Gus Dur', 'nim' => '1234567896', 'email' => 'gus.dur@example.com'],
            ['nama' => 'Habibie', 'nim' => '1234567897', 'email' => 'habibie@example.com'],
            ['nama' => 'Iwan Fals', 'nim' => '1234567898', 'email' => 'iwan.fals@example.com'],
            ['nama' => 'Joko Widodo', 'nim' => '1234567899', 'email' => 'joko.widodo@example.com'],
        ];

        foreach ($mahasiswas as $index => $mahasiswa) {
            $mahasiswaId = 'M' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            Mahasiswa::create(array_merge($mahasiswa, ['id' => $mahasiswaId]));
        }
    }
}
