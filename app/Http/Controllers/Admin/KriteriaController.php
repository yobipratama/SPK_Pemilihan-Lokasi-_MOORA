<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::with('sub_kriteria')->get();
        return view('admin.kriteria.index', ['kriterias' => $kriterias]);
    }
    public function add()
    {
        return view('admin.kriteria.add');
    }
    public function edit($id)
    {
        try {
            $kriteria = Kriteria::with('sub_kriteria')->findOrFail($id);
            return view('admin.kriteria.edit', ['kriteria' => $kriteria]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Oops, Something was wrong!');
        }
    }
    public function store(Request $request)
    {
        try {
            if (empty($request->keterangan)) {
                $request->validate([
                    'code' => 'required',
                    'name' => 'required',
                    'type' => 'required',

                ]);
            } else {
                $request->validate([
                    'code' => 'required',
                    'name' => 'required',
                    'type' => 'required',
                    'keterangan' => 'required|array',
                    'keterangan.*' => 'required|string',
                    'value' => 'required|array',
                    'value.*' => 'required|numeric',
                ]);
            }

            // Ambil semua kriteria yang ada dari database
            $allKriteria = Kriteria::all();

            // Tambahkan kriteria baru ke array
            $newKriteria = [
                'code' => $request->code,
                'name' => $request->name,
                'type' => $request->type,
            ];


            // Hitung ulang bobot untuk setiap kriteria termasuk yang baru
            $totalKriteria = $allKriteria->count() + 1;
            $bobotBaru = [];

            for ($i = 0; $i < $totalKriteria; $i++) {
                $bobot = 0;
                for ($j = $i + 1; $j <= $totalKriteria; $j++) {
                    $bobot += 1 / $j;
                }
                $bobotBaru[] = $bobot / $totalKriteria;
            }

            // Simpan kriteria baru dengan bobot yang telah dihitung
            $kriterias = Kriteria::create([
                'code' => $request->code,
                'name' => $request->name,
                'type' => $request->type,
                'value' => number_format($bobotBaru[$totalKriteria - 1], 10, '.', ''),
            ]);

            // Perbarui bobot semua kriteria yang ada di database
            foreach ($allKriteria as $index => $kriteria) {
                if (isset($kriteria->id)) {
                    Kriteria::where('id', $kriteria->id)->update(['value' => number_format($bobotBaru[$index], 10, '.', '')]);
                }
            }

            // Simpan sub-kriteria
            if ($request->keterangan) {
                foreach ($request->keterangan as $index => $keterangan) {
                    SubKriteria::create([
                        'kriterias_id' => $kriterias->id,
                        'keterangan' => $keterangan,
                        'value' => $request->value[$index],
                    ]);
                }
            }

            return to_route('admin.kriteria.index')->with('success', 'Berhasil ditambah');
        } catch (\Throwable $th) {
            dd($th);
            // return back()->with('error', 'Oops, Something was wrong!');
        }
    }

    public function update(Request $request)
    {
        try {
            if (empty($request->keterangan)) {
                $request->validate([
                    'code' => 'required',
                    'name' => 'required',
                    'type' => 'required',

                ]);
            } else {
                $request->validate([
                    'code' => 'required',
                    'name' => 'required',
                    'type' => 'required',
                    'keterangan' => 'required|array',
                    'keterangan.*' => 'required|string',
                    'value' => 'required|array',
                    'value.*' => 'required|numeric',
                ]);
            }

            $id = $request->id;

            // Perbarui kriteria
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->update([
                'code' => $request->code,
                'name' => $request->name,
                'type' => $request->type,
            ]);

            // Hapus sub-kriteria yang ada
            SubKriteria::where('kriterias_id', $id)->delete();

            // Simpan sub-kriteria baru
            foreach ($request->keterangan as $index => $keterangan) {
                SubKriteria::create([
                    'kriterias_id' => $id,
                    'keterangan' => $keterangan,
                    'value' => $request->value[$index],
                ]);
            }

            return to_route('admin.kriteria.index')->with('success', 'Berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', 'Oops, Something was wrong!');
        }
    }

    public function storesubkriteria(Request $request)
    {
        $request->validate([
            'kriterias_id' => 'required',
            'keterangan' => 'required',
            'value' => 'required',
        ]);
        try {
            SubKriteria::create($request->all());
            return back()->with('success', 'Berhasil menambah sub kriteria');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Oops, Something was wrong!');
        }
    }

    public function destroy($id)
    {
        try {
            // Hapus kriteria yang dipilih
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->sub_kriteria()->delete();
            $kriteria->delete();

            // Ambil semua kriteria yang tersisa dari database
            $allKriteria = Kriteria::all();
            $totalKriteria = $allKriteria->count();
            $bobotBaru = [];

            // Hitung ulang bobot untuk setiap kriteria yang tersisa
            for ($i = 0; $i < $totalKriteria; $i++) {
                $bobot = 0;
                for ($j = $i; $j < $totalKriteria; $j++) {
                    $bobot += 1 / ($j + 1);
                }
                $bobotBaru[] = $bobot / $totalKriteria;
            }

            // Perbarui bobot semua kriteria yang tersisa di database
            foreach ($allKriteria as $index => $kriteria) {
                $kriteria->update(['value' => $bobotBaru[$index]]);
            }
            return to_route('admin.kriteria.index')->with('success', 'Berhasil dihapus');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Oops, Something was wrongs!');
        }
    }
}
