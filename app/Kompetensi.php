<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    protected $table = 'kompetensi';
    protected $primaryKey = 'id_kompetensi';

  	protected $fillable = ['id_kompetensi','nama_kompetensi'];

  	// public function kompetensi_jabatan(){
   //  	return $this->belongsToMany('App\KompetensiJabatan');
   //  }

  	// public function kompetensi_departemen(){
   //  	return $this->belongsToMany('App\KompetensiDepartemen');
   //  }
}
