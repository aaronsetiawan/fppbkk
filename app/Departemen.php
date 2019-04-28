<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = 'departemen';
    protected $primaryKey = 'id_departemen';

  	protected $fillable = ['id_departemen','nama_departemen'];
    public $incrementing = false;
  	public function pegawai(){
    	return $this->belongsTo('App\Pegawai');
    }

  	public function kompetensi_departemen(){
    	return $this->belongsToMany('App\Kompetensi','kompetensi_departemen','id_kompetensi','id_departemen')->withPivot('id_kompetensi_departemen','level_kompetensi','kompetensi_pendahulu');
    }

  	public function divisi(){
    	return $this->hasOne('App\Divisi');
    }
}
