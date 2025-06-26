<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        // $kecamatan = Kecamatan::with('kabupaten')->get()->sortBy('nama');
        $kecamatan = Kecamatan::paginate(5);
        return view('admin.kecamatan.index', compact('kecamatan'));
    }

    public function create()
    {
        $kabupaten = Kabupaten::all()->pluck('nama', 'id');
        $kab = Kabupaten::all();
        return view('admin.kecamatan.create', compact('kabupaten', 'kab'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'id_kabupaten' => 'required'
        ]);

        $input = $request->all();
        Kecamatan::create($input);

        return redirect()->route('admin.kecamatan')
            ->with('success', 'Kecamatan Berhasil Dibuat');
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::find($id);
        // $kabupaten = Kabupaten::pluck('nama', 'id')->all();
        $kab = Kabupaten::where('id', $kecamatan->id_kabupaten)->first();
        // dd($kab);
        $kabupaten = Kabupaten::all();
        return view('admin.kecamatan.edit', compact('kecamatan', 'kabupaten', 'kab'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'id_kabupaten' => 'required'
        ]);
        $input = $request->all();
        $kecamatan = Kecamatan::find($id);
        $kecamatan->update($input);

        return redirect()->route('admin.kecamatan')
            ->with('success', 'Kecamatan berhasil di perbarui');
    }

    public function destroy($id)
    {
        Kecamatan::find($id)->delete();
        return redirect()->route('admin.kecamatan')
            ->with('success', 'Kecamatan berhasil dihapus');
    }
}
