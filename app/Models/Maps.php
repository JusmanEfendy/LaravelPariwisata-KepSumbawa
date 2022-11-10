<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Maps extends Model
{
    public function allData()
    {
        $result = DB::table('wisata')->select('nama', 'id_kelurahan', 'id_kecamatan', 'id_kategori', 'id_kabupaten', 'lat', 'lng', 'deskripsi', 'link_sampul')->get();
        return $result;
    }

    public function getLokasi($id = '')
    {
        $result = DB::table('wisata')->select('nama', 'id_kelurahan', 'id_kecamatan', 'id_kebapaten', 'deskrisi', 'link_sampul')->where('id', $id)->get();
        return $result;
    }
}
