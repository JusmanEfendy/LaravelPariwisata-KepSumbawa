<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataApprove extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'id_kategori', 'id_kelurahan', 'id_kecamatan',
        'id_kabupaten', 'fasilitas', 'deskripsi', 'lat',
        'lng', 'link_sampul', 'status', 'user_id'
    ];

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
