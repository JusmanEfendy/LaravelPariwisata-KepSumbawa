<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $fillable = ['nama', 'id_kabupaten'];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }

    public function wisata()
    {
        return $this->hasMany(Wisata::class);
    }

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class, 'id_kelurahan');
    }
}
