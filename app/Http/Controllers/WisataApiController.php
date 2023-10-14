<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use App\Http\Resources\WisataResources;
use App\Models\Kabupaten;

class WisataApiController extends Controller
{
    public function index()
    {
        $wisata = Wisata::with(['kategori:id,nama', 'kabupaten', 'kecamatan', 'kelurahan'])->orderBy('id', 'DESC')->get();


        return WisataResources::collection($wisata);
    }
}
