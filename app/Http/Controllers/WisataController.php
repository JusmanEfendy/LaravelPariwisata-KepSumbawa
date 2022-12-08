<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Kabupaten;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::with('kategori', 'kelurahan', 'kecamatan', 'kabupaten')->get()->sortBy('nama');
        return view('admin.wisata.index', compact('wisata'));
    }

    public function create()
    {
        $kategori = Kategori::all()->pluck('nama', 'id');
        $kabupaten = Kabupaten::all()->pluck('nama', 'id');
        $kecamatan = Kecamatan::all()->pluck('nama', 'id');
        $kelurahan = Kelurahan::all()->pluck('nama', 'id');
        $kat = Kategori::all();
        $kab = Kabupaten::all();
        $kec = Kecamatan::all();
        $kel = Kelurahan::all();

        return view('admin.wisata.create', compact('kategori', 'kabupaten', 'kecamatan', 'kelurahan', 'kat', 'kel', 'kec', 'kab'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'id_kategori' => 'required',
            'id_kelurahan' => 'required',
            'id_kecamatan' => 'required',
            'id_kabupaten' => 'required',
            'deskripsi' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'link_sampul' => 'image|max:2048',
        ]);
        $gambar = $request->file('link_sampul');
        $gambar->storeAs('public/wisata_images', $gambar->hashName());
        // $input = $request->all();
        Wisata::create([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'id_kelurahan' => $request->id_kelurahan,
            'id_kecamatan' => $request->id_kecamatan,
            'id_kabupaten' => $request->id_kabupaten,
            'deskripsi' => $request->deskripsi,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'link_sampul' => $gambar->hashName()
        ]);

        return redirect()->route('admin.wisata')
            ->with('success', 'Wisata Berhasil Dibuat');
    }

    public function edit($id)
    {
        $wisata = Wisata::find($id);
        $kel = Kelurahan::where('id', $wisata->id_kelurahan)->first();
        $kec = Kecamatan::where('id', $wisata->id_kecamatan)->first();
        $kab = Kabupaten::where('id', $wisata->id_kabupaten)->first();
        $kat = Kategori::where('id', $wisata->id_kategori)->first();
        $kategori = Kategori::all();
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        $kabupaten = Kabupaten::all();
        return view('admin.wisata.edit', compact('wisata', 'kat', 'kec', 'kel', 'kab', 'kecamatan', 'kabupaten', 'kelurahan', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'id_kategori' => 'required',
            'id_kelurahan' => 'required',
            'id_kecamatan' => 'required',
            'id_kabupaten' => 'required',
            'deskripsi' => 'required',
            'link_sampul' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $input = $request->all();

        $wisata = Wisata::find($id);
        $wisata->update($input);

        return redirect()->route('admin.wisata')
            ->with('success', 'Wisata berhasil di perbarui');
    }

    public function destroy($id)
    {
        Wisata::find($id)->delete();
        return redirect()->route('admin.wisata')
            ->with('success', 'Wisata berhasil dihapus');
    }
}
