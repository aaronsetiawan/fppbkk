<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'id_media';

  	protected $guarded = ['id_media'];

  	public function training(){
    	return $this->belongsTo('App\Training');
    }
}
