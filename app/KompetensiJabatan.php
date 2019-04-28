<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KompetensiJabatan extends Model
{
    protected $table = 'kompetensi_jabatan';
    protected $primaryKey = 'id_kompetensi_jabatan';

  	protected $guarded = ['id_kompetensi_jabatan','id_kompetensi','id_jabatan'];

  	public function jabatan(){
    	return $this->hasMany('App\Jabatan');
    }

    public function kompetensi(){
    	return $this->hasMany('App\Kompetensi');
    }
}
