<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kabupaten;

class Wisata extends Model
{
    protected $table = 'wisata';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_kategori', 'nama', 'id_kelurahan', 'id_kecamatan', 'id_kabupaten', 'deskripsi', 'fasilitas', 'link_sampul', 'lat', 'lng'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }
}
