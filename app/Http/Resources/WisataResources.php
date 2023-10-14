<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WisataResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nama' => $this->nama,
            'kategori' => $this->kategori->nama,
            'deskripsi' => $this->deskripsi,
            'fasilitas' => $this->fasilitas,
            'kabupaten' => $this->kabupaten->nama,
            'kecamatan' => $this->kecamatan->nama,
            'kelurahan' => $this->kelurahan->nama,
            'latitude' => $this->lat,
            'longitude' => $this->lng,
            'image' => $this->link_sampul,
        ];
    }
}
