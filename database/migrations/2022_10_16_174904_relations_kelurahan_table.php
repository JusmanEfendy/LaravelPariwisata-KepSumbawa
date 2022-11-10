<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationsKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('kelurahan', function (Blueprint $table) {
            $table->foreign('id_kecamatan')->references('id')->on('kecamatan')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('kelurahan', function (Blueprint $table) {
            $table->foreign('id_kabupaten')->references('id')->on('kabupaten')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
