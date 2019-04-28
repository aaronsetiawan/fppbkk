<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    protected $table = 'topik';
    protected $primaryKey = 'id_topik';
    public $incrementing = false;
    
  	public function training(){
    	return $this->belongsTo('App\Training');
    }
}
