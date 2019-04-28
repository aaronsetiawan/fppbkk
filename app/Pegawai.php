<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'nik_pegawai';

    public $incrementing = false;

  	public function rekapitulasi_training(){
    	return $this->belongsTo('App\RekapitulasiTraining');
    }

  	public function jabatan(){
    	return $this->hasOne('App\Jabatan');
    }

    public function departemen(){
    	return $this->hasOne('App\Departemen');
    }
}
