<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Kabupaten;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index()
    {
        // $wisata = Wisata::with('kategori', 'kelurahan', 'kecamatan', 'kabupaten')->get()->sortBy('nama');
        $wisata = Wisata::paginate(5);
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
            'fasilitas' => 'required',
            'deskripsi' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'link_sampul' => 'image|max:2048',
        ]);
        $gambar = $request->file('link_sampul');
        $gambar->storeAs('public/wisata_images', $gambar->hashName());

        Wisata::create([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'id_kelurahan' => $request->id_kelurahan,
            'id_kecamatan' => $request->id_kecamatan,
            'id_kabupaten' => $request->id_kabupaten,
            'deskripsi' => $request->deskripsi,
            'fasilitas' => $request->fasilitas,
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
            'fasilitas' => 'required',
            'deskripsi' => 'required',
            'link_sampul' => 'image|max:2048',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        // upload new image
        $wisata = Wisata::find($id);
        $gambar = $request->file('link_sampul');
        $gambar->storeAs('public/wisata_images', $gambar->hashName());

        // delete old image
        Storage::delete('wisata_images' . $wisata->link_sampul);
        // $input = $request->all();
        $wisata->update([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'id_kelurahan' => $request->id_kelurahan,
            'id_kecamatan' => $request->id_kecamatan,
            'id_kabupaten' => $request->id_kabupaten,
            'fasilitas' => $request->fasilitas,
            'deskripsi' => $request->deskripsi,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'link_sampul' => $gambar->hashName()
        ]);

        return redirect()->route('admin.wisata')
            ->with('success', 'Wisata berhasil di perbarui');
    }

    public function destroy(Wisata $id)
    {
        if ($id->link_sampul) {
            Storage::delete('wisata_images' . $id->link_sampul);
        }
        Wisata::destroy($id->id);
        return redirect()->route('admin.wisata')
            ->with('success', 'Wisata berhasil dihapus');
    }
}
