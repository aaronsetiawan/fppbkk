<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyelenggara extends Model
{
    protected $table = 'penyelenggara';
    protected $primaryKey = 'id_penyelenggara';

  	protected $guarded = ['id_penyelenggara'];

  	public function training(){
    	return $this->belongsTo('App\Training');
    }
}
