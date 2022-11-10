<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'Kabupaten';
    protected $fillable = ['nama'];

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'id_kecamatan');
    }

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class);
    }

    public function wisata()
    {
        return $this->hasMany(Wisata::class);
    }
}
