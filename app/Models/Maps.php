<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Maps extends Model
{
    public function allData()
    {
        $result = DB::table('wisata')->select('kelurahan.nama as nama_kelurahan', 'kecamatan.nama as nama_kecamatan', 'kabupaten.nama as nama_kabupaten', 'kategori.nama as nama_kategori', 'wisata.lat as lat', 'wisata.lng as lng', 'wisata.fasilitas as fasilitas', 'wisata.nama as nama_wisata', 'wisata.deskripsi as deskripsi', 'wisata.link_sampul as gambar')->join('kelurahan', 'kelurahan.id', '=', 'wisata.id_kelurahan')->join('kecamatan', 'kecamatan.id', '=', 'wisata.id_kecamatan')->join('kabupaten', 'kabupaten.id', '=', 'wisata.id_kabupaten')->join('kategori', 'kategori.id', '=', 'wisata.id_kategori')->get();
        return $result;
    }

    public function getLokasi($id = '')
    {
        $result = DB::table('wisata')->select('id', 'nama', 'id_kelurahan', 'id_kecamatan', 'id_kebapaten', 'deskrisi', 'link_sampul')->where('id', $id)->get();
        return $result;
    }
}
