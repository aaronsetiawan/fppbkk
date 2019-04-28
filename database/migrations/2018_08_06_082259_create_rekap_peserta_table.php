<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekapPesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_peserta', function (Blueprint $table) {
            $table->increments('id_rekap_peserta');
            // $table->date('tanggal');
            // $table->integer('jumlah_jam');
            // $table->integer('jumlah_peserta');
            // $table->integer('jumlah_kegiatan');
            // $table->integer('jumlah_pegawai_mengikuti_training');
            // $table->integer('jumlah_pegawai_mengikuti_giat');
            // $table->integer('jumlah_pegawai_mengikuti_juara');
            // $table->integer('total_pegawai');
            // $table->integer('rata_jam_per_pegawai');
            // $table->integer('rata_hari_per_pegawai');
            $table->date('tanggal_akhir');
            $table->integer('jumlah_jam');
            $table->string('nama_training');
            $table->integer('periode');
            $table->string('nama_peserta');
            $table->string('media');
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
        Schema::dropIfExists('rekap_peserta');
    }
}
