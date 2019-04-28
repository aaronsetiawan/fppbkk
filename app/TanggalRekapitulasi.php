<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TanggalRekapitulasi extends Model
{
	protected $table = 'tanggal_rekapitulasi';
    protected $primaryKey = 'id_tanggal_rekapitulasi';

  	protected $guarded = ['id_tanggal_rekapitulasi'];

    public function rekapitulasi_training(){
    	return $this->hasMany('App\Jabatan');
    }

    public function tanggal_training(){
    	return $this->hasMany('App\Kompetensi');
    }
}
