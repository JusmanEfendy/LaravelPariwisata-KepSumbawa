<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\WisataApprove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TambahkanWisata extends Controller
{
    public function index()
    {
        $tambahkanWisata = WisataApprove::where('user_id', Auth::user()->id)->orderBy('nama', 'asc')->paginate(5);
        return view('wisatawan.index', compact('tambahkanWisata'));
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

        return view('wisatawan.create', compact('kategori', 'kabupaten', 'kecamatan', 'kelurahan', 'kat', 'kel', 'kec', 'kab'));
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

        WisataApprove::create([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'id_kelurahan' => $request->id_kelurahan,
            'id_kecamatan' => $request->id_kecamatan,
            'id_kabupaten' => $request->id_kabupaten,
            'deskripsi' => $request->deskripsi,
            'fasilitas' => $request->fasilitas,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'link_sampul' => $gambar->hashName(),
            'user_id' => Auth::user()->id,
            'status' => 'pending'
        ]);

        return redirect()->route('admin.tambahkan-wisata')
            ->with('success', 'Data wisata berhasil diajukan dan menunggu persetujuan admin.');
    }
}
