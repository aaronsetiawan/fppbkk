<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTanggalRekapitulasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggal_rekapitulasi', function (Blueprint $table) {
            $table->increments('id_tanggal_rekapitulasi');
            $table->timestamps();


            $table->integer('id_rekapitulasi_training')->unsigned();
            $table->foreign('id_rekapitulasi_training')->references('id_rekapitulasi_training')->on('rekapitulasi_training')->onUpdate('cascade')->onDelete('cascade');


            $table->integer('id_tanggal_training');
            $table->foreign('id_tanggal_training')->references('id_tanggal_training')->on('tanggal_training')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanggal_rekapitulasi');
    }
}
