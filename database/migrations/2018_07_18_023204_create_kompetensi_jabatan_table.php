<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKompetensiJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetensi_jabatan', function (Blueprint $table) {
            $table->increments('id_kompetensi_jabatan')->unsigned();
            $table->integer('id_kompetensi');
            $table->string('id_jabatan',50);
            $table->integer('level_kompetensi');
            $table->integer('kompetensi_pendahulu')->nullable();
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
        Schema::dropIfExists('kompetensi_jabatan');
    }
}
