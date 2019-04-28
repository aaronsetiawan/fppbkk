<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapitulasiTraining extends Model
{
    protected $table = 'rekapitulasi_training';
    protected $primaryKey = 'id_rekapitulasi_training';

  	protected $guarded = ['id_rekapitulasi_training','status_training'];

  	public function training(){
    	return $this->hasOne('App\Training');
    }

  	public function pegawai(){
    	return $this->hasOne('App\Pegawai');
    }

  	public function tanggal_training(){
    	return $this->hasMany('App\TanggalTraining');
    }
}
