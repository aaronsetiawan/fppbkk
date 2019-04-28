<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'training';
    protected $primaryKey = 'id_training';

  	public function media(){
    	return $this->hasOne('App\Media');
    }

  	public function topik(){
    	return $this->hasOne('App\Topik');
    }

  	public function penyelenggara(){
    	return $this->hasOne('App\Penyelenggara');
    }

  	public function rekapitulasi_training(){
    	return $this->belongsTo('App\RekapitulasiTraining');
    }
    
}
