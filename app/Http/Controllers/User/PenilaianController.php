<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\DetailPenilaian;
use App\Models\KriPenilaian;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\SubPenilaian;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class PenilaianController extends Controller
{
    public function index(): View
    {
        $kriterias = Kriteria::with('sub_kriteria')->get();
        $alternatifs = Alternatif::get();
        return view('user.penilaian.index', [
            "kriterias" => $kriterias,
            'alternatifs' => $alternatifs,
        ]);
    }

    public function history(): View
    {
        $penilaian = Penilaian::where('user_id', Auth::user()->id)->get();
        return view('user.penilaian.history', [
            'penilaian' => $penilaian,
        ]);
    }

    public function detail_history($id)
    {
        $penilaian = SubPenilaian::with('kri_penilaians')->where('penilaian_id', $id)->get();
        $kriterias = Kriteria::select('value', 'type')->get();

        $bobot = [];
        $types = [
            "benefits" => [],
            "costs" => []
        ];
        // bobot
        $i = 0;
        foreach ($kriterias as $kriteria) {
            array_push($bobot, $kriteria->value);
            if ($kriteria->type == "Benefit") {
                array_push($types["benefits"], $i);
            } else {
                array_push($types["costs"], $i);
            }
            $i++;
        }


        $matrix = [];
        foreach ($penilaian as $p) {
            $temp = [];
            foreach ($p->kri_penilaians as $kri) {
                array_push($temp, $kri->bobot);
            }
            array_push($matrix, $temp);
        }

        $bobotBaru = $this->pembobotan($bobot);
        $matrix_normalisasi = $this->normalisasi($matrix);
        $matrix_normalisasi_w = $this->normalisasi_w($matrix_normalisasi, $bobotBaru);
        $minmax = $this->minmax($matrix_normalisasi_w, $types);

        $x = 0;
        foreach ($penilaian as $p) {
            array_unshift($matrix[$x], $p->alternatif);
            array_unshift($matrix_normalisasi[$x], $p->alternatif);
            array_unshift($matrix_normalisasi_w[$x], $p->alternatif);
            $minmax[$x] = [$p->alternatif, $minmax[$x]];
            $x++;
        }

        $hasilRanking = $this->rangking($minmax);

        $x = 0;

        $penilaian = Penilaian::find($id);
        if (!$penilaian->alternatif) {
            $penilaian->alternatif = $hasilRanking[0][0];
            $penilaian->save();
        }

        return view('user.penilaian.detail', [
            'matrix_normalisasi' => $matrix_normalisasi,
            'matrix_normalisasi_w' => $matrix_normalisasi_w,
            'matrix' => $matrix,
            'ranking' => $hasilRanking,
            'id' => $penilaian->id,
        ]);
    }

    // ROC
    private function pembobotan($bobot)
    {
        $sumKriteria = count($bobot);
        $hasil = [];
        for ($baris = 0; $baris < $sumKriteria; $baris++) {
            $temp = [];
            for ($kolom = $baris; $kolom < $sumKriteria; $kolom++) {
                $bobotBaru = 1 / ($kolom + 1);
                array_push($temp, $bobotBaru);
            }
            array_push($hasil, array_sum($temp) / $sumKriteria);
        }
        return $hasil;
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'data' => 'required|array',
            ]);

            $data = $request->data;


            $penilaian = Penilaian::create([
                'user_id' => Auth::user()->id,
            ]);

            $subPenilaianMap = [];

            foreach ($data as $item) {
                $sub = SubPenilaian::create([
                    'penilaian_id' => $penilaian->id,
                    'alternatif' => $item["lokasi"]
                ]);
                $subPenilaianMap[$item["lokasi"]] = $sub->id;
            }

            foreach ($data as $kri) {
                foreach ($kri["value"] as $value) {
                    KriPenilaian::create([
                        'sub_penilaian_id' => $subPenilaianMap[$kri["lokasi"]],
                        'bobot' => $value
                    ]);
                }
            }

            return $penilaian->id;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    private function minmax($matrix, $type)
    {
        $result = [];
        for ($i = 0; $i < count($matrix); $i++) {
            $max = 0;
            foreach ($type["benefits"] as $value) {
                $max += $matrix[$i][$value];
            }

            $min = 0;
            foreach ($type["costs"] as $value) {
                $min += $matrix[$i][$value];
            }
            array_push($result, abs($max - $min));

        }
        return $result;
    }

    private function normalisasi($matrix)
    {
        $jumlah_baris = count($matrix);
        $jumlah_kolom = count($matrix[0]);

        // matrix normalisasi
        $matrix_normalisasi = [];
        for ($i = 0; $i < $jumlah_baris; $i++) {
            $temp_norm = [];
            for ($j = 0; $j < $jumlah_kolom; $j++) {
                $b = 0;
                for ($x = 0; $x < $jumlah_baris; $x++) {
                    $b += $matrix[$x][$j] ** 2;
                }
                $rij = $matrix[$i][$j] / sqrt($b);
                $b = 0;
                array_push($temp_norm, $rij);
            }
            array_push($matrix_normalisasi, $temp_norm);
            $temp_norm = [];
        }
        return $matrix_normalisasi;
    }

    private function normalisasi_w($matrix, $bobot)
    {
        $jumlah_baris = count($matrix);
        $jumlah_kolom = count($matrix[0]);
        $matrix_normalisasi_w = [];
        for ($iw=0; $iw < $jumlah_baris; $iw++) {
            $temp_norm_w = [];
            for ($jw=0; $jw < $jumlah_kolom; $jw++) {
                $v = $matrix[$iw][$jw] * $bobot[$jw];
                array_push($temp_norm_w, $v);
            }
            array_push($matrix_normalisasi_w, $temp_norm_w);
        }
        return $matrix_normalisasi_w;
    }

    private function rangking($matrix)
    {
        $sort = $matrix;
        usort($sort, function ($a, $b) {
            return $b[1] <=> $a[1];
        });
        return $sort;
    }


    public function generatePdf($id)
    {
        $penilaian = SubPenilaian::with('kri_penilaians')->where('penilaian_id', $id)->get();
        $kriterias = Kriteria::select('value', 'type')->get();
        $bobot = [];
        $types = [
            "benefits" => [],
            "costs" => []
        ];
        // bobot
        $i = 0;
        foreach ($kriterias as $kriteria) {
            array_push($bobot, $kriteria->value);
            if ($kriteria->type == "Benefit") {
                array_push($types["benefits"], $i);
            } else {
                array_push($types["costs"], $i);
            }
            $i++;
        }

        $matrix = [];
        foreach ($penilaian as $p) {
            $temp = [];
            foreach ($p->kri_penilaians as $kri) {
                array_push($temp, $kri->bobot);
            }
            array_push($matrix, $temp);
        }
        $bobotBaru = $this->pembobotan($bobot);
        $matrix_normalisasi = $this->normalisasi($matrix);
        $matrix_normalisasi_w = $this->normalisasi_w($matrix_normalisasi, $bobotBaru);
        $minmax = $this->minmax($matrix_normalisasi_w, $types);

        $x = 0;
        foreach ($penilaian as $p) {
            $minmax[$x] = [$p->alternatif, $minmax[$x]];
            $x++;
        }

        $hasilRanking = $this->rangking($minmax);

        $data = [
            'title' => 'Hasil Perangkingan Menggunakan ROC dan Moora',
            'rangking' => $hasilRanking,
        ];

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('user.pdf.document', $data));

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        return $dompdf->stream('document.pdf');
    }
}
