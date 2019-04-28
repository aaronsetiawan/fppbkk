<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KompetensiDepartemen extends Model
{
    protected $table = 'kompetensi_departemen';
    protected $primaryKey = 'id_kompetensi_departemen';

  	protected $guarded = ['id_kompetensi_departemen','id_kompetensi','id_departemen'];

  	public function departemen(){
    	return $this->hasMany('App\Departemen');
    }

    public function kompetensi(){
    	return $this->hasMany('App\Kompetensi');
    }
}
