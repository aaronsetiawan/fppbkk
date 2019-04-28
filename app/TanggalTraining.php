<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TanggalTraining extends Model
{
    protected $table = 'tanggal_training';
    protected $primaryKey = 'id_tanggal_training';

  	protected $guarded = ['id_tanggal_training'];

  	public function tanggal_rekapitulasi(){
    	return $this->belongsToMany('App\RekapitulasiTraining','rekapitulasi_training','id_rekapitulasi_training','id_tanggal_training');
    }
}
