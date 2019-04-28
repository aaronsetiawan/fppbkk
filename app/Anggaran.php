<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    protected $table = 'anggaran';
    protected $primaryKey = 'id_anggaran';

  	protected $guarded = ['id_anggaran'];
}
