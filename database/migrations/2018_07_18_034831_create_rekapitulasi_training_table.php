<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekapitulasiTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapitulasi_training', function (Blueprint $table) {
            $table->increments('id_rekapitulasi_training')->unsigned();
            $table->string('nik_pegawai',50);
            $table->string('status_training',20);
            $table->string('justifikasi',50);
            $table->integer('jumlah_jam_training');
            $table->integer('harga_training');
            $table->integer('periode')->nullable();
            $table->integer('invoice_training')->nullable();
            $table->string('fpt_file',100)->nullable();
            $table->string('pendaftaran_file',100)->nullable();
            $table->string('undangan_file',100)->nullable();
            $table->string('absensi_file',100)->nullable();
            $table->string('sertifikat_file',100)->nullable();
            $table->string('eval_file',100)->nullable();
            $table->string('invoice_file',100)->nullable();
            $table->integer('biaya_lain')->nullable();
            $table->string('keterangan_lain',100)->nullable();
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
        Schema::dropIfExists('rekapitulasi_training');
    }
}
