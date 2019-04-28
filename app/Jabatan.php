<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';

  	protected $guarded = ['id_jabatan'];
  	public $incrementing = false;

  	public function pegawai(){
    	return $this->belongsTo('App\Pegawai');
    }

    public function kompetensi_jabatan(){
    	return $this->belongsToMany('App\Kompetensi','kompetensi_jabatan','id_kompetensi','id_jabatan')->withPivot('id_kompetensi_jabatan','level_kompetensi','kompetensi_pendahulu');
    }
}
