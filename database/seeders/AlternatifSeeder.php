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
            ['code' => 'A1',  'alternatif' => 'Desa Tawangargo, Kec. Karang Ploso, Kabupaten Malang'],
            ['code' => 'A2',  'alternatif' => 'Desa Giripurno, Kec. Bumiaji, Kota Batu'],
            ['code' => 'A3',  'alternatif' => 'Desa Pendem, Kec. Junrejo, Kota Batu'],
            ['code' => 'A4',  'alternatif' => 'Desa Bonowarih, Kec. Karang Ploso, Kabupaten Malang'],
        ];
        foreach ($data as $item) {
            Alternatif::create($item);
        }
    }
}
