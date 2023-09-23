<?php

namespace Database\Seeders;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class CreateKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = [
            'Taman',
            'Gunung',
            'Pantai',
            'Air Terjun',
            'Pulau',
        ];
    
        foreach ($kategoris as $kategori) {
            Kategori::create(['nama' => $kategori]);
        }
    }
}
