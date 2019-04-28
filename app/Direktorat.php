<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direktorat extends Model
{
    protected $table = 'direktorat';
    protected $primaryKey = 'id_direktorat';

  	protected $guarded = ['id_direktorat'];

  	public function divisi(){
    	return $this->belongsTo('App\Divisi');
    }
}
