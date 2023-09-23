<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('id_kategori')->unsigned();
            $table->string('nama', 100);
            $table->bigInteger('id_kelurahan')->unsigned();
            $table->bigInteger('id_kecamatan')->unsigned();
            $table->bigInteger('id_kabupaten')->unsigned();
            $table->text('deskripsi');
            $table->text('fasilitas')->nullable();
            $table->text('link_sampul')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wisata');
    }
}
