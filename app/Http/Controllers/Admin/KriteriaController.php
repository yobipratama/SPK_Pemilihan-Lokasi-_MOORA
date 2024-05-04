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
            'value' => 'required',
        ]);
        try {
            Kriteria::create($request->all());
            return to_route('admin.kriteria.index')->with('success', 'Berhasil ditambah');
        } catch (\Throwable $th) {
            return back()->with('error', 'Oops, Something was wrong!');
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

    public function destroy($id) {
        try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->delete();
            return to_route('admin.kriteria.index')->with('success', 'Berhasil dihapus');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Oops, Something was wrongs!');
        }
    }
}
