<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataKriteria = [
            [
                'code' => 'C1', 'name' => 'Harga Lokasi', 'type' => 'Cost', 'value' => 1,
            ],
            [
                'code' => 'C2', 'name' => 'Luas Tanah', 'type' => 'Benefit', 'value' => 1,
            ],
            [
                'code' => 'C3', 'name' => 'Pasar Sasaran', 'type' => 'Benefit', 'value' => 1,
            ],
            [
                'code' => 'C4', 'name' => 'Banyak Penduduk/Keramaian', 'type' => 'Benefit', 'value' => 1,
            ],
            [
                'code' => 'C5', 'name' => 'Aksesibilitas', 'type' => 'Benefit', 'value' => 1,
            ],
            [
                'code' => 'C6', 'name' => 'Kompetitor/Jumlah Usaha Pesaing', 'type' => 'Cost', 'value' => 1,
            ],
        ];

        $dataSubKriteria = [
            [
                'kriterias_id' => 3, // 'Pasar Sasaran
                'keterangan' => 'Kampus',
                'value' => 3
            ],
            [
                'kriterias_id' => 3, // 'Pasar Sasaran
                'keterangan' => 'Wisata',
                'value' => 2
            ],
            [
                'kriterias_id' => 3, // 'Pasar Sasaran
                'keterangan' => 'Pusat Perbelanjaan',
                'value' => 1
            ],
            [
                'kriterias_id' => 5, // 'Aksesibilitas
                'keterangan' => 'Dapat dilalui semua jenis kendaraan',
                'value' => 3
            ],
            [
                'kriterias_id' => 5, // 'Aksesibilitas
                'keterangan' => 'Hanya dilalui mobil kecil dan motor',
                'value' => 2
            ],
            [
                'kriterias_id' => 5, // 'Aksesibilitas
                'keterangan' => 'Hanya dilalui motor saja',
                'value' => 1
            ],
        ];

        try {
            foreach ($dataKriteria as $kriteria) {
                Kriteria::create($kriteria);
            }
            foreach ($dataSubKriteria as $subKriteria) {
                SubKriteria::create($subKriteria);
            }
        } catch (\Throwable $th) {
            echo $th;
            DB::rollBack();
        }
    }
}
