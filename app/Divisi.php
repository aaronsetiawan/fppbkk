<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi';

  	protected $fillable = ['id_divisi','nama_divisi'];
    public $incrementing = false;

   	public function direktorat(){
    	return $this->hasOne('App\Direktorat');
    }
  	
  	public function departemen(){
    	return $this->belongsTo('App\Departemen');
    }
    
}
