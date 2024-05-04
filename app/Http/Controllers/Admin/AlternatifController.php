<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = DB::table('alternatifs')->select('id', 'code', 'alternatif')->get();
        return view('admin.alternatif.index', ['alternatif' => $alternatif]);
    }

    public function add()
    {
        return view('admin.alternatif.add');
    }

    public function edit($id)
    {
        try{
            $alternatif = Alternatif::findOrFail($id);
            return view('admin.alternatif.edit',['alternatif' => $alternatif]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Opps, Something was wrong!');
        }
    
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'code' => 'required',
            'alternatif' => 'required',
        ]);
        try {
            $alternatif = Alternatif::create($request->all());
            
            $alternatif->code = 'A'.$alternatif->id;
            $alternatif->save();

            return to_route('admin.alternatif.index')->with('success', 'Alternatif berhasil ditambah');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Opps, Something was wrong!');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'alternatif' => 'required',
        ]);
        try {
            Alternatif::where('id',$request->id,)->update([
                'code' => $request->code,
                'alternatif' => $request->alternatif,
            ]);
    
            return to_route('admin.alternatif.index')->with('success', 'Alternatif berhasil dirubah');
        } catch (\Throwable $th) {
            return back()->with('error', 'Opps, Something was wrong!');
        }
    }

    public function destroy($id){
        try{
            $alternatif = Alternatif::findOrFail($id);
            $alternatif->delete();
            return back()->with('success', 'Berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('error', 'Opps, Something was wrong!');
        }
    }
}
