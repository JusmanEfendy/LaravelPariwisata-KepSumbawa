<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

// JUSSY LOGIC
class KelurahanController extends Controller
{
    public function index()
    {
        // $kelurahan = Kelurahan::with('kabupaten', 'kecamatan')->get()->sortBy('nama');
        $kelurahan = Kelurahan::paginate(10);
        return view('admin.kelurahan.index', compact('kelurahan'));
    }

    public function create()
    {
        $kabupaten = Kabupaten::all()->pluck('nama', 'id');
        $kecamatan = Kecamatan::all()->pluck('nama', 'id');
        $kab = Kabupaten::all();
        $kec = Kecamatan::all();
        // $kelurahan = Kelurahan::find($id);
        // $kec = Kecamatan::where('id', $kelurahan->id_kecamatan)->first();
        // $kab = Kabupaten::where('id', $kelurahan->id_kabupaten)->first();
        // $kecamatan = Kecamatan::all();
        // $kabupaten = Kabupaten::all();
        return view('admin.kelurahan.create', compact('kabupaten', 'kecamatan', 'kab', 'kec'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'id_kecamatan' => 'required',
            'id_kabupaten' => 'required'
        ]);

        $input = $request->all();
        // dd($input);
        Kelurahan::create($input);

        return redirect()->route('admin.kelurahan')
            ->with('success', 'Kelurahan Berhasil Dibuat');
    }

    public function edit($id)
    {
        $kelurahan = Kelurahan::find($id);
        // $kecamatan = Kecamatan::pluck('nama', 'id');
        //$kabupaten = Kabupaten::pluck('nama', 'id');
        $kec = Kecamatan::where('id', $kelurahan->id_kecamatan)->first();
        $kab = Kabupaten::where('id', $kelurahan->id_kabupaten)->first();
        $kecamatan = Kecamatan::all();
        $kabupaten = Kabupaten::all();
        // dd($kabupaten);
        return view('admin.kelurahan.edit', compact('kelurahan', 'kecamatan', 'kabupaten', 'kab', 'kec'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'id_kecamatan' => 'required',
            'id_kabupaten' => 'required'
        ]);
        $input = $request->all();
        $kelurahan = Kelurahan::find($id);
        $kelurahan->update($input);

        return redirect()->route('admin.kelurahan')
            ->with('success', 'Kelurahan berhasil di perbarui');
    }

    public function destroy($id)
    {
        Kelurahan::find($id)->delete();
        return redirect()->route('admin.kelurahan')
            ->with('success', 'Kelurahan berhasil dihapus');
    }
}
