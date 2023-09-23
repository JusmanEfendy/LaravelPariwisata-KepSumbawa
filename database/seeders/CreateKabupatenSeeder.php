<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use Illuminate\Database\Seeder;

class CreateKabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kabupatens = [
            'Sumbawa',
            'Sumbawa Barat',
            'Bima',
            'Dompu',
        ];
    
        foreach ($kabupatens as $kabupaten) {
            Kabupaten::create(['nama' => $kabupaten]);
        }
    }
}
