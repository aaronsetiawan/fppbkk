<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaxminTanggalTrainingView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW maxmin_tanggal_training AS
                SELECT DISTINCT tanggal_rekapitulasi.`id_rekapitulasi_training`, min(tanggal_training.`tanggal_training`) as tgl_min, max(tanggal_training.`tanggal_training`) as tgl_max FROM tanggal_training, tanggal_rekapitulasi WHERE tanggal_training.`id_tanggal_training` = tanggal_rekapitulasi.`id_tanggal_training` GROUP BY tanggal_rekapitulasi.`id_rekapitulasi_training`
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
