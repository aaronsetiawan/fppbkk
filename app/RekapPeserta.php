<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapPeserta extends Model
{
    protected $table = 'rekap_peserta';
    protected $primaryKey = 'id_rekap_peserta';

  	protected $guarded = ['id_rekap_peserta'];

}
