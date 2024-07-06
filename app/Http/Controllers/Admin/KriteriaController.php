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
            $kriteria = Kriteria::findOrFail($id);
            return view('admin.kriteria.edit', ['kriteria' => $kriteria]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Oops, Something was wrong!');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',

        ]);

        try {
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

            SubKriteria::create([
                'kriterias_id' => $kriterias->id,
                'keterangan' => $request->keterangan,
                'value' => $request->value,
            ]);

            return to_route('admin.kriteria.index')->with('success', 'Berhasil ditambah');
        } catch (\Throwable $th) {
            dd($th);
            // return back()->with('error', 'Oops, Something was wrong!');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'value' => 'required',
        ]);
        try {
            Kriteria::where('id', $request->id)->update($request->except('_token'));
            return back()->with('success', 'Berhasil diupdate');
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
