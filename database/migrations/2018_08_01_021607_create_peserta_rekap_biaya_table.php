<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertaRekapBiayaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW peserta_rekap_biaya AS
                select monthname(maxmin_tanggal_training.`tgl_max`) as bulan, training.`id_training`, training.`nama_training`, media.`nama_media`, media.`kategori_media`, maxmin_tanggal_training.`tgl_max`, penyelenggara.`nama_penyelenggara`, sum(rekapitulasi_training.`invoice_training`) as total from rekapitulasi_training, maxmin_tanggal_training, media, penyelenggara, training where rekapitulasi_training.`id_rekapitulasi_training` = maxmin_tanggal_training.`id_rekapitulasi_training` AND training.`id_training` = rekapitulasi_training.`id_training` AND media.`id_media` = training.`id_media` AND penyelenggara.`id_penyelenggara` = training.`id_penyelenggara` AND rekapitulasi_training.`status_training` = 'Terlaksana' group by training.`nama_training`, bulan
        ");
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
