<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['code' => 'A1',  'alternatif' => 'Desa Girimoyo'],
            ['code' => 'A2',  'alternatif' => 'Desa Donowarih'],
            ['code' => 'A3',  'alternatif' => 'Desa Pendem'],
            ['code' => 'A4',  'alternatif' => 'Desa Punten'],
        ];
        foreach ($data as $item) {
            Alternatif::create($item);
        }
    }
}
