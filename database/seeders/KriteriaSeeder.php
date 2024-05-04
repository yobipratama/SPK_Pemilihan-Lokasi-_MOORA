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
        $data = [
            [
                'code' => 'C1', 'name' => 'Harga Lokasi', 'type' => 'Cost', 'value' => 1, 'sub_categories' => [
                    [
                        'name' => 'Terjangkau',
                        'value' => 3
                    ],
                    [
                        'name' => 'Mahal',
                        'value' => 2
                    ],

                    [
                        'name' => 'Sangat Mahal',
                        'value' => 1
                    ],
                ],
            ],
            [
                'code' => 'C2', 'name' => 'Luas Tanah', 'type' => 'Benefit', 'value' => 1,  'sub_categories' => [
                    [
                        'name' => '> 300m2',
                        'value' => 3
                    ],
                    [
                        'name' => '200 - 300m2',
                        'value' => 2
                    ],
                    [
                        'name' => '< 200 m2',
                        'value' => 1
                    ],
                ],
            ],
            [
                'code' => 'C3', 'name' => 'Pasar Sasaran', 'type' => 'Benefit', 'value' => 1,  'sub_categories' => [
                    [
                        'name' => 'Kampus',
                        'value' => 4
                    ],
                    [
                        'name' => 'Pusat Perbelanjaan',
                        'value' => 3
                    ],
                    [
                        'name' => 'Perkantoran',
                        'value' => 2
                    ],
                    [
                        'name' => 'Tidak Ada',
                        'value' => 1
                    ],
                ],
            ],
            [
                'code' => 'C4', 'name' => 'Banyak Penduduk/Keramaian', 'type' => 'Benefit', 'value' => 1,  'sub_categories' => [
                    [
                        'name' => 'Sangat Padat',
                        'value' => 3
                    ],
                    [
                        'name' => 'Padat',
                        'value' => 2
                    ],
                    [
                        'name' => 'Cukup Padat',
                        'value' => 1
                    ]
                ],
            ],
            ['code' => 'C5', 'name' => 'Aksesibilitas', 'type' => 'Benefit', 'value' => 1,  'sub_categories' => [
                [
                    'name' => 'Dapat dilalui semua jenis kendaraan',
                    'value' => 3
                ],
                [
                    'name' => 'Hanya dilalui mobil kecil dan motor',
                    'value' => 2
                ],
                [
                    'name' => 'Hanya dilalui motor saja',
                    'value' => 1
                ]
            ],],
            [
                'code' => 'C6', 'name' => 'Kompetitor/Jumlah Usaha Pesaing', 'type' => 'Cost', 'value' => 1,  'sub_categories' => [
                    [
                        'name' => 'Tinggi',
                        'value' => 3
                    ],
                    [
                        'name' => 'Sedang',
                        'value' => 2
                    ],
                    [
                        'name' => 'Rendah',
                        'value' => 1
                    ]
                ],
            ],
        ];

        try {
            DB::beginTransaction();
            // Looping data dan menyimpannya ke dalam database
            foreach ($data as $item) {
                $user = Kriteria::create([
                    'code' => $item['code'],
                    'name' => $item['name'],
                    'type' => $item['type'],
                    'value' => $item['value'],
                ]);

                foreach ($item['sub_categories'] as $sub) {
                    SubKriteria::create([
                        'kriterias_id' => $user->id,
                        'keterangan' => $sub['name'],
                        'value' => $sub['value'],
                    ]);
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            echo $th;
            DB::rollBack();
        }
    }
}
